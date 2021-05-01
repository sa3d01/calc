<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\Auth\ResendEmailVerificationRequest;
use App\Http\Requests\Api\Auth\VerifyEmailRequest;
use App\Http\Resources\UserLoginResourse;
use App\Models\EmailVerificationCode;
use App\Models\User;
use App\Traits\UserEmailVerificationTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VerifyController extends MasterController
{
    use UserEmailVerificationTrait;

    public function resendEmailVerification(ResendEmailVerificationRequest $request): object
    {
        $user = User::where('email', $request['email'])->first();
        if ($user->email_verified_at != null) {
            return $this->sendError('هذا الحساب مفعل.');
        }
        $unexpired_code_sent = EmailVerificationCode::where('email', $request['email'])->where('expires_at', '>', Carbon::now())->latest()->first();
        if ($unexpired_code_sent) {
            return $this->sendError('تم ارسال كود التفعيل من قبل.');
        }
        $this->createEmailVerificationCodeForUser($user);
        return $this->sendResponse([], 'تم إرسال كود التفعيل بنجاح .');
    }

    public function verifyEmail(VerifyEmailRequest $request): object
    {
        $user = User::where('email', $request['email'])->first();
        if ($user->email_verified_at != null) {
            return $this->sendError('هذا الحساب مفعل.');
        }
        $verificationCode = EmailVerificationCode::where([
            'email' => $request['email'],
            'code' => $request['code'],
        ])->latest()->first();
        if (!$verificationCode) {
            return $this->sendError('كود التفعيل غير صحيح! حاول مرة أخرى.');
        }
        if (Carbon::now()->gt(Carbon::parse($verificationCode->expires_at))) {
            return $this->sendError('Code expired. ');
        }
        DB::transaction(function () use ($user, $verificationCode) {
            $now = Carbon::now();
            $verificationCode->update(['verified_at' => $now]);
            $user->update(['email_verified_at' => $now]);
        });
        return $this->sendResponse(new UserLoginResourse($user));
    }
}
