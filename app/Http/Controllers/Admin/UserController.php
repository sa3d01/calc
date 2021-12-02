<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends MasterController
{
    public function __construct(User $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->where('type','USER')->latest()->get();
        return view('Dashboard.user.index', compact('rows'));
    }
    public function show($id):object
    {
        $user=$this->model->find($id);
        return view('Dashboard.user.show', compact('user'));
    }
    public function ban($id):object
    {
        $user=$this->model->find($id);
        $user->update(
            [
                'banned'=>1,
            ]
        );
        $user->refresh();
        return redirect()->back()->with('updated');
    }
    public function activate($id):object
    {
        $user=$this->model->find($id);
        $user->update(
            [
                'banned'=>0,
            ]
        );
        $user->refresh();
        return redirect()->back()->with('updated');
    }
    public function edit($id):object
    {
        $row=$this->model->find($id);
        return view('Dashboard.user.edit', compact('row'));
    }
    public function update($id, Request $request)
    {
        $page = $this->model->find($id);
        $page->update($request->all());
        return redirect()->back()->with('updated');
    }

}
