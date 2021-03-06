<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DropDown;
use App\Models\Notification;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

abstract class MasterController extends Controller
{

    protected $model;
    protected $route;
    protected $module_name;
    protected $single_module_name;
    protected $index_fields;
    protected $show_fields;
    protected $create_fields;
    protected $update_fields;
    protected $json_fields;

    public function __construct()
    {
        $this->middleware('auth:admin');
        $new_users_count=User::where('type','USER')->where('created_at','>',Carbon::now()->subDays(7))->count();
        $all_users_count=User::where('type','USER')->count();
        $unread_notifications_count=Notification::where(['type'=>'admin','read'=>'false'])->count();
        $notifications=Notification::where(['type'=>'admin','read'=>'false'])->latest()->get();
        view()->share(array(
            'module_name' => $this->module_name,
            'single_module_name' => $this->single_module_name,
            'route' => $this->route,
            'index_fields' => $this->index_fields,
            'show_fields' => $this->show_fields,
            'create_fields' => $this->create_fields,
            'update_fields' => $this->update_fields,
            'json_fields' => $this->json_fields,
            'new_users_count'=>$new_users_count,
            'all_users_count'=>$all_users_count>0?$all_users_count:1,
            'notifications'=>$notifications,
            'unread_notifications_count'=>$unread_notifications_count,
           ));
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('Dashboard.' . $this->route . '.index', compact('rows'));
    }

    public function create()
    {
        return view('Dashboard.' . $this->route . '.create');
    }

//    public function store(Request $request)
//    {
//        $this->validate($request, $this->validation_func(1), $this->validation_msg());
//        $this->model->create($request->all());
//        return redirect('admin/' . $this->route . '')->with('created', '?????? ?????????????? ??????????');
//    }

    public function edit($id)
    {
        $row = $this->model->find($id);
        return View('Dashboard.' . $this->route . '.edit', compact('row'));
    }

    public function update($id, Request $request)
    {
        $this->validate($request, $this->validation_func(2, $id), $this->validation_msg());
        $obj = $this->model->find($id);
        $obj->update($request->all());
        return redirect()->back()->with('updated', '???? ?????????????? ??????????');
    }

    public function destroy($id)
    {
        $this->model->find($id)->delete();
        return redirect()->back()->with('deleted', '???? ?????????? ??????????');
    }

    public function show($id)
    {
        $row = $this->model->find($id);
        return View('Dashboard.' . $this->route . '.show', compact('row'));
    }
}

