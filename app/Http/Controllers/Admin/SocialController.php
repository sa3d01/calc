<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;

class SocialController extends MasterController
{
    public function __construct(Setting $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function social(): object
    {
        $snap = $this->model->first()->socials['snap'];
        $twitter = $this->model->first()->socials['twitter'];
        $facebook = $this->model->first()->socials['facebook'];
        $instagram = $this->model->first()->socials['instagram'];
        $youtube = $this->model->first()->socials['youtube'];
        $email = $this->model->value('email');
        $mobile = $this->model->value('mobile');
        return view('Dashboard.social.edit', compact('snap','twitter','facebook','instagram','youtube','email','mobile'));
    }

    public function updateSocial(Request $request):object
    {
        $setting = $this->model->first();
        $setting->update([
           'socials'=>[
               'snap'=>$request['snap'],
               'twitter'=>$request['twitter'],
               'facebook'=>$request['facebook'],
               'instagram'=>$request['instagram'],
               'youtube'=>$request['youtube'],
           ],
            'email'=>$request['email'],
            'mobile'=>$request['mobile']
        ]);
        return redirect()->back()->with('updated');
    }

}
