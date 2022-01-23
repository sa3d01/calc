<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Notification;
use App\Models\User;
use Edujugon\PushNotification\PushNotification;
use Illuminate\Http\Request;

class ContactController extends MasterController
{
    public function __construct(Contact $model)
    {
        $this->model = $model;
        parent::__construct();
    }


    public function index()
    {
        $rows = $this->model->latest()->get();
        foreach ($rows as $row) {
            $row->update([
                'read' => true
            ]);
        }
        return view('Dashboard.contact.index', compact('rows'));
    }

    public function replyContact($id, Request $request)
    {
        $data['title']='admin message';
        $data['note'] = $request['note'];
        $contact = Contact::find($id);
        $push = new PushNotification('fcm');
        $feedback=$push->setMessage([
            'notification' => array('title'=>$data['title'],'body' => $data['note'], 'sound' => 'default'),
            'data' => [
                'title' => $data['title'],
                'body' => $data['note'],
                'status' => 'admin',
                'type' => 'admin',
            ],
            'priority' => 'high',
        ])
            ->setApiKey('AAAAZFO9N5A:APA91bHE5RG-EniUqgZgv3zIIiapopJGLIc_l5G8bs0bja5_hnwnyx0vERYLQGm5rc2i2cVCagh8LrnczvIoWnetmcibE9-uUVt2VLyUGjbJwh8-Owb6DON76NVJGo_eqpbZozC82kvK')
            ->setDevicesToken($contact->user->device['id'])
            ->send()
            ->getFeedback();
        print_r($feedback);
        return;
        Notification::create([
            'receiver_id' => $contact->user_id,
            'admin_notify_type' => 'single',
            'type' => 'app',
            'title' => $data['title'],
            'note' => $data['note'],
            'more_details' => [
                'type' => 'admin_reply',
                'contact_id' => $id
            ]
        ]);
        return redirect()->back()->with('success', 'تم الارسال بنجاح');
    }

    public function delete($id)
    {
        $this->model->find($id)->delete();
        return redirect()->back()->with('deleted', 'تم الحذف بنجاح');
    }


}
