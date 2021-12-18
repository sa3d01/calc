<?php

namespace App\Http\Controllers\Admin;

use App\Models\FormulaNutrient;
use Illuminate\Http\Request;

class FormulaNutrientController extends MasterController
{
    public function __construct(FormulaNutrient $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->latest()->get();
        return view('Dashboard.formula_nutrient.index', compact('rows'));
    }

    public function create()
    {
        return view('Dashboard.formula_nutrient.create');
    }

    public function edit($id): object
    {
        $row = $this->model->find($id);
        return view('Dashboard.formula_nutrient.edit', compact('row'));
    }

    public function update($id, Request $request): object
    {
        $row = $this->model->find($id);
        $row->update($request->all());
        $rows = $this->model->latest()->get();
        return view('Dashboard.formula_nutrient.index', compact('rows'));
    }

    public function store(Request $request): object
    {
        $this->model->create($request->all());
        $rows = $this->model->latest()->get();
        return view('Dashboard.formula_nutrient.index', compact('rows'));
    }
}
