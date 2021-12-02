<?php

namespace App\Http\Controllers\Admin;

use App\Models\DropDown;
use Illuminate\Http\Request;

class FormulaContentOfNutrientsController extends MasterController
{
    public function __construct(DropDown $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function classifications()
    {
        $rows = $this->model->where('class', 'FormulaNutrientsClassification')->latest()->get();
        return view('Dashboard.formula_classifications.index', compact('rows'));
    }

    public function createClassifications()
    {
        return view('Dashboard.formula_classifications.create-classification');
    }

    public function editClassifications($id): object
    {
        $row = $this->model->find($id);
        return view('Dashboard.formula_classifications.edit-classification', compact('row'));
    }

    public function updateClassifications($id, Request $request): object
    {
        $row = $this->model->find($id);
        $row->update(['name' => $request['name']]);
        $rows = $this->model->where('class', 'FormulaNutrientsClassification')->latest()->get();
        return view('Dashboard.formula_classifications.index', compact('rows'));
    }

    public function storeClassifications(Request $request): object
    {
        $this->model->create(['name' => $request['name'], 'class' => 'FormulaNutrientsClassification']);
        $rows = $this->model->where('class', 'FormulaNutrientsClassification')->latest()->get();
        return view('Dashboard.formula_classifications.index', compact('rows'));
    }

    public function ban($id): object
    {
        $row = $this->model->find($id);
        $row->update(
            [
                'status' => 0,
            ]
        );
        if ($row->parent_id == null) {
            $rows = $this->model->where('class', 'FormulaNutrientsClassification')->latest()->get();
            return view('Dashboard.formula_classifications.index', compact('rows'));
        }
        $rows = $this->model->where('class', 'FormulaNutrients')->latest()->get();
        return view('Dashboard.formula_classifications.formula_nutrients', compact('rows'));
    }

    public function activate($id): object
    {
        $row = $this->model->find($id);
        $row->update(
            [
                'status' => 1,
            ]
        );
        if ($row->parent_id == null) {
            $rows = $this->model->where('class', 'FormulaNutrientsClassification')->latest()->get();
            return view('Dashboard.formula_classifications.index', compact('rows'));
        }
        $rows = $this->model->where('class', 'FormulaNutrients')->latest()->get();
        return view('Dashboard.formula_classifications.formula_nutrients', compact('rows'));
    }

    public function formula_nutrients()
    {
        $rows = $this->model->where('class', 'FormulaNutrients')->latest()->get();
        return view('Dashboard.formula_classifications.formula_nutrients', compact('rows'));
    }

    public function createFormulaNutrients()
    {
        return view('Dashboard.formula_classifications.create-formula-nutrients');
    }

    public function editFormulaNutrients($id): object
    {
        $row = $this->model->find($id);
        return view('Dashboard.formula_classifications.edit-formula-nutrients', compact('row'));
    }

    public function updateFormulaNutrients($id, Request $request): object
    {
        $row = $this->model->find($id);
        $row->update(['name' => $request['name'], 'parent_id' => $request['parent_id']]);
        $rows = $this->model->where('class', 'FormulaNutrients')->latest()->get();
        return view('Dashboard.formula_classifications.formula_nutrients', compact('rows'));
    }

    public function storeFormulaNutrients(Request $request): object
    {
        $this->model->create(['name' => $request['name'], 'class' => 'FormulaNutrients', 'parent_id' => $request['parent_id']]);
        $rows = $this->model->where('class', 'FormulaNutrients')->latest()->get();
        return view('Dashboard.formula_classifications.formula_nutrients', compact('rows'));
    }
}
