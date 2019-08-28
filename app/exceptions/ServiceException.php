<?php

namespace app\exceptions;

use Throwable;
use yii\base\Exception;

class ServiceException extends Exception
{
    public $errors;

    /**
     * ServiceException constructor.
     * @param $errors
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($errors, $message = "", $code = 0, Throwable $previous = null)
    {
        $this->errors = $errors;
        parent::__construct($message, $code, $previous);
    }
}