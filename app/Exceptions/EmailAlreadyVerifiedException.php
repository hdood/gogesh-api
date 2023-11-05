<?php

declare(strict_types=1);

namespace App\Exceptions;

use Couchbase\BaseException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class EmailAlreadyVerifiedException extends BaseException
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct(__('register.email_already_verified'), Response::HTTP_UNAUTHORIZED, $previous);
    }
}
