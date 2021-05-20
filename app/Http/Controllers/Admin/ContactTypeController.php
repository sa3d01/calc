<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bank;
use App\Models\Category;
use App\Models\ContactType;
use App\Models\User;
use Illuminate\Http\Request;

class ContactTypeController extends MasterController
{
    public function __construct(ContactType $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('Dashboard.contact-type.index', compact('rows'));
    }
    public function edit($id):object
    {
        $row=$this->model->find($id);
        return view('Dashboard.contact-type.edit', compact('row'));
    }
    public function update($id,Request $request)
    {
        $row=$this->model->find($id);
        $data = $request->all();
        $row->update($data);
        return redirect()->route('admin.contact_type.index')->with('created');
    }
    public function create()
    {
        return view('Dashboard.contact-type.create');
    }
    public function store(Request $request)
    {
        $data=$request->all();
        $this->model->create($data);
        return redirect()->route('admin.contact_type.index')->with('created');
    }

    public function ban($id):object
    {
        $type=$this->model->find($id);
        $type->update(
            [
                'status'=>0,
            ]
        );
        $type->refresh();
        return redirect()->back()->with('updated');
    }
    public function activate($id):object
    {
        $type=$this->model->find($id);
        $type->update(
            [
                'status'=>1,
            ]
        );
        $type->refresh();
        return redirect()->back()->with('updated');
    }

}
