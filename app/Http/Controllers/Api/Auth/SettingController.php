<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\Auth\PasswordUpdateRequest;
use App\Http\Requests\Api\Auth\ProfileUpdateRequest;
use App\Http\Requests\Api\UploadImageRequest;
use App\Http\Resources\UserLoginResourse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SettingController extends MasterController
{

    public function updateProfile(ProfileUpdateRequest $request): object
    {
        $user = auth('api')->user();
        $data = $request->validated();
        $data['last_ip'] = $request->ip();
        $user->update($data);
        return $this->sendResponse(new UserLoginResourse($user));
    }

    public function updatePassword(PasswordUpdateRequest $request): object
    {
        $user = auth('api')->user();
        if (Hash::check($request['old_password'], $user->password)) {
            $user->update([
                'password' => $request['new_password'],
            ]);
            return $this->sendResponse(new UserLoginResourse($user));
        }
        return $this->sendError('كلمة المرور غير صحيحة.');
    }

    public function uploadImage(UploadImageRequest $request): object
    {
        if ($request['type'] == 'avatar') {
            $user = auth('api')->user();
            $user->update([
                'image' => $request->file('image')
            ]);
            $image = $user->image;
        } else {
            $file = $request->file('image');
            $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move('media/images/', $request['type'] . '/' . $filename);
            $image = asset('media/images/') . '/' . $request['type'] . '/' . $filename;
        }
        return $this->sendResponse([
            "image" => $image
        ]);
    }
}
