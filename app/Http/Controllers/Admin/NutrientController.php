<?php

namespace App\Http\Controllers\Admin;

use App\Models\DropDown;
use Illuminate\Http\Request;

class NutrientController extends MasterController
{
    public function __construct(DropDown $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $class = "Nutrient";
        $rows = $this->model->where('class', $class)->latest()->get();
        return view('Dashboard.drop-down.index', compact('rows', 'class'));
    }

    public function create()
    {
        $class = "Nutrient";
        return view('Dashboard.drop-down.create', compact('class'));
    }

    public function edit($id)
    {
        $row = $this->model->find($id);
        $class = $row->class;
        return view('Dashboard.drop-down.edit', compact('row', 'class'));
    }

    public function update($id, Request $request): object
    {
        $row = $this->model->find($id);
        $row->update($request->all());
        $class = $row->class;
        $rows = $this->model->where('class', $class)->latest()->get();
        return view('Dashboard.drop-down.index', compact('rows', 'class'));
    }

    public function store(Request $request): object
    {
        $row = $this->model->create($request->all());
        $class = $row->class;
        $rows = $this->model->where('class', $class)->latest()->get();
        return view('Dashboard.drop-down.index', compact('rows', 'class'));
    }

    public function ban($id): object
    {
        $row = $this->model->find($id);
        $row->update(
            [
                'status' => 0,
            ]
        );
        $class = $row->class;
        $rows = $this->model->where('class', $class)->latest()->get();
        return view('Dashboard.drop-down.index', compact('rows', 'class'));
    }

    public function activate($id): object
    {
        $row = $this->model->find($id);
        $row->update(
            [
                'status' => 1,
            ]
        );
        $class = $row->class;
        $rows = $this->model->where('class', $class)->latest()->get();
        return view('Dashboard.drop-down.index', compact('rows', 'class'));
    }
}
