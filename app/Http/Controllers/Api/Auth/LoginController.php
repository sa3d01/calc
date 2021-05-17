<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Resources\UserLoginResourse;
use App\Models\User;
use App\Traits\UserEmailVerificationTrait;

class LoginController extends MasterController
{
    use UserEmailVerificationTrait;

    public function login(LoginRequest $request): object
    {
        $credentials = $request->only('email', 'password');
        $user = User::where(['email' => $request['email'], 'type' => 'USER'])->first();
        if (!$user) {
            return $this->sendError('هذا الحساب غير موجود.');
        }
        if (!$user->email_verified_at) {
            $this->createEmailVerificationCodeForUser($user);
            return $this->sendError('هذا الحساب غير مفعل.', ['email_verified' => false]);
        }
        if (auth('api')->attempt($credentials)) {
            return $this->sendResponse(new UserLoginResourse($user));
        }
        return $this->sendError('كلمة المرور غير صحيحة.');
    }

    public function logout(): object
    {
        $user = auth('api')->user();
        $user->update([
            'device' => [
                'id' => null,
                'os' => null,
            ]
        ]);
        auth('api')->logout();
        return $this->sendResponse([], "Logged out successfully.");
    }
}
