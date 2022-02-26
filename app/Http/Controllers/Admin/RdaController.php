<?php

namespace App\Http\Controllers\Admin;

use App\Models\DropDown;
use Illuminate\Http\Request;

class RdaController extends MasterController
{
    public function __construct(DropDown $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function listRdaCategory()
    {
        $class="RdaCategory";
        $rows = $this->model->where('class', $class)->latest()->get();
        return view('Dashboard.drop-down.index', compact('rows','class'));
    }
    public function listAgeCategory()
    {
        $class="AgeCategory";
        $rows = $this->model->where('class', $class)->latest()->get();
        return view('Dashboard.drop-down.index', compact('rows','class'));
    }
    public function createRdaCategory()
    {
        $class="RdaCategory";
        return view('Dashboard.drop-down.create', compact('class'));
    }
    public function createAgeCategory()
    {
        $class="AgeCategory";
        return view('Dashboard.drop-down.create', compact('class'));
    }
    public function editRdaCategory($id)
    {
        $row = $this->model->find($id);
        $class=$row->class;
        return view('Dashboard.drop-down.edit', compact('row','class'));
    }
    public function editAgeCategory($id)
    {
        $row = $this->model->find($id);
        $class=$row->class;
        return view('Dashboard.drop-down.edit', compact('row','class'));
    }
    public function updateRdaCategory($id, Request $request): object
    {
        $row = $this->model->find($id);
        $row->update($request->all());
        $class=$row->class;
        $rows = $this->model->where('class', $class)->latest()->get();
        return view('Dashboard.drop-down.index', compact('rows','class'));
    }
    public function updateAgeCategory($id, Request $request): object
    {
        $row = $this->model->find($id);
        $row->update($request->all());
        $class=$row->class;
        $rows = $this->model->where('class', $class)->latest()->get();
        return view('Dashboard.drop-down.index', compact('rows','class'));
    }

    public function storeRdaCategory(Request $request): object
    {
        $row=$this->model->create($request->all());
        $class=$row->class;
        $rows = $this->model->where('class', $class)->latest()->get();
        return view('Dashboard.drop-down.index', compact('rows','class'));
    }
    public function storeAgeCategory(Request $request): object
    {
        $row=$this->model->create($request->all());
        $class=$row->class;
        $rows = $this->model->where('class', $class)->latest()->get();
        return view('Dashboard.drop-down.index', compact('rows','class'));
    }

    public function ban($id): object
    {
        $row = $this->model->find($id);
        $row->update(
            [
                'status' => 0,
            ]
        );
        $class=$row->class;
        $rows = $this->model->where('class', $class)->latest()->get();
        return view('Dashboard.drop-down.index', compact('rows','class'));
    }

    public function activate($id): object
    {
        $row = $this->model->find($id);
        $row->update(
            [
                'status' => 1,
            ]
        );
        $class=$row->class;
        $rows = $this->model->where('class', $class)->latest()->get();
        return view('Dashboard.drop-down.index', compact('rows','class'));
    }
}
