<?php

namespace App\Exceptions;
use Symfony\Component\HttpFoundation\Response;

use Exception;

class UnauthorizedException extends BaseException
{

    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct(__('authorize.your_password_is_incorrect')
            , Response::HTTP_UNAUTHORIZED, $previous);
    }
}
