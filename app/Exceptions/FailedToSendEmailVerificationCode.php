<?php

declare(strict_types=1);

namespace App\Exceptions;

use Throwable;

final class FailedToSendEmailVerificationCode extends BaseException
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct(__('email.failed_send'), 400, $previous);
    }
}
