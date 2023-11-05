<?php

namespace App\Actions\Email;

use App\Exceptions\EmailVerfication\ExpiredCodeProvidedException;
use App\Exceptions\ExpiredUrlProvidedException;
use App\Exceptions\InvalidUrlProvidedException;
use App\Http\Requests\EmailVerfication\EmailVerificationRequest;
use App\Models\EmailVerificationCode;
use App\Repository\Api\CustomerRepository;
use App\Repository\Api\SellerRepository;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EmailVerificationAction
{
    public function __construct(private readonly SellerRepository $sellerRepository)
    {
    }

    /**
     * @throws InvalidUrlProvidedException
     * @throws ExpiredUrlProvidedException
     */
    public function execute(EmailVerificationRequest $request): void
    {
        $verification = EmailVerificationCode::where("email", $request->email)->first();

        if (Carbon::parse($verification->created_at)->addMinutes(2)->timestamp < now()->timestamp) {
            throw new ExpiredCodeProvidedException();
        }
    }
}
