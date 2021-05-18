<?php

namespace App\Http\Controllers\Admin;

use App\Models\DropDown;
use App\Models\User;

class FormulaContentOfNutrientsController extends MasterController
{
    public function __construct(DropDown $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function classifications()
    {
        $rows = $this->model->where('class','FormulaNutrientsClassification')->latest()->get();
        return view('Dashboard.formula_classifications.index', compact('rows'));
    }
    public function show($id):object
    {
        $row=$this->model->find($id);
        return view('Dashboard.formula_classifications.show', compact('row'));
    }
    public function ban($id):object
    {
        $user=$this->model->find($id);
        $user->update(
            [
                'status'=>0,
            ]
        );
        $user->refresh();
        return redirect()->back()->with('updated');
    }
    public function activate($id):object
    {
        $row=$this->model->find($id);
        $row->update(
            [
                'status'=>1,
            ]
        );
        $row->refresh();
        return redirect()->back()->with('updated');
    }

}
