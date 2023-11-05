<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class CommercialActivityRejectedException extends BaseException
{

    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct(__('commercial_activity.your_commercial_activity_rejected')
            , Response::HTTP_UNAUTHORIZED, $previous);
    }
}
