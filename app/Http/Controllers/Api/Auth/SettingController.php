<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\Auth\PasswordUpdateRequest;
use App\Http\Requests\Api\Auth\ProfileUpdateRequest;
use App\Http\Requests\Api\UploadImageRequest;
use App\Http\Resources\UserLoginResourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\EmailVerificationCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        return $this->sendError('password incorrect.');
    }

    public function uploadImage(UploadImageRequest $request): object
    {
        $user = auth('api')->user();
        $user->update([
            'image' => $request->file('image')
        ]);
        $image = $user->image;
        return $this->sendResponse([
            "image" => $image
        ]);
    }

    public function requestUpdatePhone(Request $request)
    {
        $user = auth()->user();
        $user->update([
            'new_phone'=>$request['new_phone']
        ]);
        $code=1111;//rand(1111,9999);
        $data = [
            'user_id' => $user->id,
            'email' => $user->email,
            'phone' => $request['new_phone'],
            'code' => $code,
            'expires_at' => Carbon::now()->addMinutes(15),
        ];
        EmailVerificationCode::create($data);
        $this->sendMessage('كود التفعيل CLN   :'.$code,$request['new_phone']);
        return $this->sendResponse([
            'new_phone'=>$request['new_phone'],
            'activation_code' => $code
        ]);
    }

    public function updatePhone(Request $request)
    {
        $user = auth()->user();
        $verificationCode = EmailVerificationCode::where([
            'phone' => $request['new_phone'],
            'code' => $request['code'],
        ])->latest()->first();
        if (!$verificationCode) {
            return $this->sendError('code incorrect.');
        }
        if (Carbon::now()->gt(Carbon::parse($verificationCode->expires_at))) {
            return $this->sendError('Code expired. ');
        }
        DB::transaction(function () use ($user, $verificationCode) {
            $now = Carbon::now();
            $verificationCode->update(['verified_at' => $now]);
            $user->update([
                'email_verified_at' => $now,
                'phone' => $verificationCode['phone'],
            ]);
        });
        return $this->sendResponse(new UserLoginResourse($user));
    }

    private function sendMessage($message, $phoneNumber)
    {
        $getdata = http_build_query(
            $fields = array(
                "Username" => "0530005107",
                "Password" => "Ahsan5107",
                "Message" => $message,
                "RecepientNumber" => $phoneNumber,
                "ReplacementList" => "",
                "SendDateTime" => "0",
                "EnableDR" => False,
                "Tagname" => "CL-N",
                "VariableList" => "0"
            ));
        $opts = array('http' =>
            array(
                'method' => 'GET',
                'header' => 'Content-type: application/x-www-form-urlencoded',

            )
        );
        $context = stream_context_create($opts);
        $results = file_get_contents('http://api.yamamah.com/SendSMSV2?' . $getdata, false, $context);
        return $results;
    }

}
