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
            return $this->sendError('account not found.');
        }
        if (!$user->email_verified_at) {
            $this->createEmailVerificationCodeForUser($user);
            $response = [
                'status' => 200,
                'message' => 'unverified',
                'data' => ['email_verified' => false],
            ];
            return response()->json($response);
        }
        if (auth('api')->attempt($credentials)) {
            if ($user->banned==1){
                $response = [
                    'status' => 401,
                    'message' => 'you are banned from admin ..',
                ];
                return response()->json($response, 401);
            }
            return $this->sendResponse(new UserLoginResourse($user));
        }
        return $this->sendError('password incorrect.');
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
