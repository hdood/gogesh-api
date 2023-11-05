<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidSocialiteProvider extends BaseException
{
    public function __construct($message = '', $code = 0, Throwable $previous = null)
    {
        parent::__construct(__('register.you_can_only_authenticate_via_google_or_facebook_or_apple_account'), 401, $previous);
    }
}
