<?php

namespace App\GraphQL;

use GraphQL\Error\Error;
use Rebing\GraphQL\Error\ValidationError;

class ErrorHandler
{
    public static function formatError(Error $e)
    {
        $exceptionObj = $e->getPrevious();
        if ($exceptionObj instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            $modelName = last(explode('\\', $exceptionObj->getModel())); // Extract Model name
            return ['message' =>  __('message.entityNotFound', [ 'entity' => $modelName ]) ];
        }

        $error['message'] = $e->getMessage();
        $validationErrorMsg = null;
        $previous = $e->getPrevious();
        if ($previous && $previous instanceof ValidationError) {
            $errorMessage = $previous->getValidatorMessages()->toArray();
            foreach ($errorMessage as $key => $message) {
                if (strpos($key, 'input.') === 0) {
                    $key = str_replace('input.', "", $key);
                }
                $message  = str_replace('input.', "", $message);
                $error['fields'][$key] = $message;
                if (is_null($validationErrorMsg)) {
                    $validationErrorMsg = $error['fields'][$key];
                }
            }
        }

        if (! is_null($validationErrorMsg)) {
            $error['message'] = $validationErrorMsg[0];
        }
        return $error;
    }
}