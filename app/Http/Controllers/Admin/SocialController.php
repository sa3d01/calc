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
        return view('Dashboard.social.edit', compact('snap','twitter','facebook','instagram'));
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
           ]
        ]);
        return redirect()->back()->with('updated');
    }

}
