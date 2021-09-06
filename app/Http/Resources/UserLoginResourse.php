<?php

namespace App\Http\Resources;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserLoginResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $token = auth('api')->login(User::find($this->id));
        User::find($this->id)->update([
            'device' => [
                'id' => $request['device.id'],
                'os' => $request['device.os'],
            ],
            'last_login_at' => Carbon::now(),
            'last_ip' => $request->ip(),
        ]);
        return [
            "user" => [
                'id' => (int)$this->id,
                'type' => $this->type,
                'name' => $this->name,
                'phone' => $this->phone ?? "",
                'email' => $this->email ?? "",
                'city' => [
                    'id' => $this->city ? (int)$this->city->id : 0,
                    'name' => $this->city ? $this->city->name : "",
                ],
                'image' => $this->image,
            ],
            "access_token" => [
                'token' => $token,
                'token_type' => 'Bearer',
            ],

        ];
    }
}
