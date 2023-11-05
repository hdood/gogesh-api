<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class CodeExpiredException extends BaseException
{
    //

    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct(__('passwords.code_is_expire'), 422, $previous);
    }

}
