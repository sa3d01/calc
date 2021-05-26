<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Notification;
use App\Models\User;
use Edujugon\PushNotification\PushNotification;
use Illuminate\Http\Request;

class NotificationController extends MasterController
{
    public function __construct(Notification $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function clearAdminNotifications()
    {
        $unread_notifications=Notification::where(['type'=>'admin','read'=>'false'])->get();
        foreach ($unread_notifications as $unread_notification){
            $unread_notification->update([
               'read'=>'true'
            ]);
        }
        return redirect()->back();
    }
    public function readNotification($id)
    {
        $unread_notification=Notification::find($id);
        $unread_notification->update([
            'read'=>'true'
        ]);
        return redirect()->back();
    }
    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('Dashboard.notification.index', compact('rows'));
    }

    public function store(Request $request)
    {
        $data['title']='admin message';
        $data['note']=$request['note'];
        $users=User::where('type','USER')->get();
        $usersTokens=[];
        $usersIds=[];
        foreach ($users as $user){
            if ($user->device['id'] !='null'){
                $usersTokens[]=$user->device['id'];
                $usersIds[]=$user->id;
            }
        }
        $push = new PushNotification('fcm');
        $push->setMessage([
            'notification' => array('title'=>$data['note'], 'sound' => 'default'),
            'data' => [
                'title' => $data['note'],
                'body' => $data['note'],
                'status' => 'admin',
                'type'=>'admin',
            ],
            'priority' => 'high',
        ])
            ->setDevicesToken($usersTokens)
            ->send();
        $this->model->create([
            'receivers'=>$usersIds,
            'admin_notify_type'=>'all',
            'title'=>$data['note'],
            'note'=>$data['note'],
        ]);
        return redirect()->back()->with('success','تم الارسال بنجاح');
    }

    public function sendSingleNotification($id,Request $request)
    {
        $contact=Contact::find($id);
        $data['title']='admin message';
        $data['note']=$request['note'];
        $push = new PushNotification('fcm');
        $push->setMessage([
            'notification' => array('title'=>$data['note'], 'sound' => 'default'),
            'data' => [
                'title' => $data['note'],
                'body' => $data['note'],
                'status' => 'admin',
                'type'=>'admin',
            ],
            'priority' => 'high',
        ])
            ->setDevicesToken($contact->user->device['id'])
            ->send();
        $this->model->create([
            'receiver_id'=>$contact->user_id,
            'admin_notify_type'=>'single',
            'title'=>$data['note'],
            'note'=>$data['note'],
        ]);
        return redirect()->back()->with('success','تم الارسال بنجاح');
    }

}
