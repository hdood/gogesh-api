<?php

namespace App\Repository\Api;

use App\Models\ResetCodePassword;

class ResetPasswordRepository
{

    private $model;

    public function __construct(ResetCodePassword $codePassword)
    {
        $this->model = $codePassword;
    }


    function create($array):ResetCodePassword
    {
        return ResetCodePassword::create($array);
    }

    function deleteByEmail($email): void
    {
        ResetCodePassword::where('email', $email)->delete();
    }

    function firstWhere($array):ResetCodePassword{
       return ResetCodePassword::firstWhere($array);
    }

}
