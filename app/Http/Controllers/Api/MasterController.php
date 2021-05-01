<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResourse;
use App\Models\Notification;
use Edujugon\PushNotification\PushNotification;
use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Object_;

abstract class MasterController extends Controller
{
    protected $model;

    public function __construct()
    {
    }

    public function sendResponse($result, $message = null)
    {
        $response = [
            'status' => 200,
            'message' => $message!=null ? $message : '',
            'data' => $result,
        ];
        return response()->json($response);
    }

    public function sendError($error,$data=[], $code = 400)
    {
        $response = [
            'status' => $code,
            'message' => $error,
            'data' => $data,
        ];
        return response()->json($response, $code);
    }

    function fcmPush($title,$user,$order)
    {
        if (in_array('id',$user->device)){
            $push = new PushNotification('fcm');
            $msg = [
                'notification' => array('title' => $title, 'sound' => 'default'),
                'data' => [
                    'title' => $title,
                    'body' => $title,
                    'status' => $order->status,
                    'type' => 'order',
                    'order' => new OrderResourse($order),
                ],
                'priority' => 'high',
            ];
            $push->setMessage($msg)
                ->setDevicesToken($user->device['id'])
                ->send();
        }
    }
    public function notify_user($user,$title, $order)
    {
        $this->fcmPush($title,$user,$order);
        $notification['title'] = $title;
        $notification['note'] = $title;
        $notification['receiver_id'] = $user->id;
        Notification::create($notification);
    }
}
