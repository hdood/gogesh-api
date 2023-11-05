<?php

declare(strict_types=1);

namespace App\Exceptions\EmailVerfication;

use App\Exceptions\BaseException;
use Throwable;

final class ExpiredCodeProvidedException extends BaseException
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct(__('email.code_expired'), 400, $previous);
    }
}


