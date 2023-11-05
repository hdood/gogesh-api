<?php

namespace App\Actions\PrivacyPolicy;


use App\Enum\EnumGeneral;
use App\Repository\SettingRepository;

class GetPrivacyPolicyAction
{

    public function __construct(private readonly SettingRepository $repository)
    {
    }

    public function execute():string
    {
        return $this->repository->getByKey(EnumGeneral::PRIVACY_POLICY)->getValue();
    }

}
