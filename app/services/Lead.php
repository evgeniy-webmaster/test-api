<?php

namespace app\services;

use app\models\Lead as Model;

use app\exceptions\ServiceException;

class Lead
{
    public static function search(?int $createdBy = null, ?string $status = null, ?int $offset = null, ?int $limit = null)
    {
        return Model::find()
            ->andFilterWhere([
                'created_by' => $createdBy,
                'status' => $status,
            ])
            ->offset($offset)
            ->limit($limit)
            ->all();
    }

    public static function create(array $data)
    {
        $model = new Model($data);

        if (!$model->save()) {
            throw new ServiceException($model->errors);
        }
    }
}