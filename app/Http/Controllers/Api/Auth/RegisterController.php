<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\Auth\UserRegisterationRequest;
use App\Models\User;
use App\Traits\UserEmailVerificationTrait;
use Spatie\Permission\Models\Role;

class RegisterController extends MasterController
{
    use UserEmailVerificationTrait;

    public function register(UserRegisterationRequest $request): object
    {
        $data = $request->validated();
        $data['last_ip'] = $request->ip();
        $user = User::create($data);
        $user->refresh();
        $role = Role::findOrCreate($user->type);
        $user->assignRole($role);

        $this->createEmailVerificationCodeForUser($user);
        return $this->sendResponse([
            "email" => $request["email"],
            "phone" => $request["phone"],
        ]);
    }
}
