<?php

namespace App\Traits;

use App\Models\EmailVerificationCode;
use Carbon\Carbon;

trait UserEmailVerificationTrait
{

    protected function createEmailVerificationCodeForUser($user)
    {
        $data = [
            'user_id' => $user->id,
            'email' => $user->email,
            'code' => 2021,//rand(1111, 9999),
            'expires_at' => Carbon::now()->addMinutes(15),
        ];
        EmailVerificationCode::create($data);
        //todo : send sms
        return $data;
    }

}
