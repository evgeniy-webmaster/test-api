<?php

namespace app\controllers;

use yii\filters\ContentNegotiator;
use yii\web\Response;
use app\exceptions\ServiceException;
use app\services\Lead;
use app\models\User;
use Yii;

class LeadController extends \yii\web\Controller
{
    const HTTP_STATUS_CREATED = 201;
    const HTTP_STATUS_UNPROCESSABLE_ENTITY = 422;

    public $enableCsrfValidation = false;

    public $serializer = 'yii\rest\Serializer';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    'index'  => ['GET'],
                    'create' => ['POST'],
                ],
            ],
            'basicAuth' => [
                'class' => \yii\filters\auth\HttpBasicAuth::class,
                'auth' => function ($username, $password) {
                    $user = User::findByUsername($username);
                    if ($user->validatePassword($password)) {
                        return $user;
                    }
                    return null;
                }
            ],
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    'application/xml' => Response::FORMAT_XML,
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $created_by = Yii::$app->request->get('created_by');
        $status = Yii::$app->request->get('status');
        $offset = Yii::$app->request->get('offset');
        $limit = Yii::$app->request->get('limit');

        return Lead::search($created_by, $status, $offset, $limit);
    }

    public function actionCreate()
    {
        try {
            Lead::create(Yii::$app->request->bodyParams);
            Yii::$app->response->statusCode = self::HTTP_STATUS_CREATED;
            return true;
        } catch (ServiceException $e) {
            Yii::$app->response->statusCode = self::HTTP_STATUS_UNPROCESSABLE_ENTITY;
            return $e->errors;
        }
    }
}
