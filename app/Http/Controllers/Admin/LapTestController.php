<?php

namespace App\Http\Controllers\Admin;

use App\Models\DropDown;
use App\Models\LapTest;
use Illuminate\Http\Request;

class LapTestController extends MasterController
{
    public function __construct(LapTest $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('Dashboard.lap-test.index', compact('rows'));
    }

    public function create()
    {
        $factors = DropDown::where(['class' => 'Factor', 'status' => 1])->get();
        return view('Dashboard.lap-test.create', compact('factors'));
    }

    public function edit($id)
    {
        $row = $this->model->find($id);
        $factors = DropDown::where(['class' => 'Factor', 'status' => 1])->get();
        return view('Dashboard.lap-test.edit', compact('row', 'factors'));
    }

    public function update($id, Request $request): object
    {
        $row = $this->model->find($id);
        $row->update($request->all());
        $rows = $this->model->latest()->get();
        return view('Dashboard.lap-test.index', compact('rows'));
    }

    public function store(Request $request): object
    {
        $this->model->create($request->all());
        $rows = $this->model->latest()->get();
        return view('Dashboard.lap-test.index', compact('rows'));
    }
}
