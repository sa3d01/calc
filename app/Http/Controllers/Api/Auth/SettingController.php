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
use App\Utils\PreparePhone;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
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
        if ($request->has('new_phone')) {
            $new_phone = new PreparePhone($request->new_phone);
            if (!$new_phone->isValid()) {
                throw new HttpResponseException(response()->json([
                    'status' => 400,
                    'message' => $new_phone->errorMsg()
                ], 200));
            }
            $request->merge(['new_phone' => $new_phone->getNormalized()]);
        }
        if ($request['new_phone']==$user->phone) {
            return $this->sendError('new phone incorrect.');
        }
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
        if ($request->has('new_phone')) {
            $new_phone = new PreparePhone($request->new_phone);
            if (!$new_phone->isValid()) {
                throw new HttpResponseException(response()->json([
                    'status' => 400,
                    'message' => $new_phone->errorMsg()
                ], 200));
            }
            $request->merge(['new_phone' => $new_phone->getNormalized()]);
        }
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
        return $this->sendResponse(new UserLoginResourse($user),' تم تحديث رقم الهاتف بنجاح');
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
