<?php

namespace App\Http\Controllers\Admin;

use App\Models\DropDown;
use App\Models\NutrientFactor;
use Illuminate\Http\Request;

class DrugController extends MasterController
{
    public function __construct(DropDown $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $class = "Drug";
        $rows = $this->model->where('class', $class)->latest()->get();
        return view('Dashboard.drop-down.index', compact('rows', 'class'));
    }

    public function create()
    {
        $class = "Drug";
        return view('Dashboard.drop-down.create', compact('class'));
    }

    public function edit($id)
    {
        $row = $this->model->find($id);
        $class = $row->class;
        $nutrient_factors=NutrientFactor::where(['drug_id'=>$row->id])->get();
        return view('Dashboard.drop-down.edit', compact('row', 'class','nutrient_factors'));
    }

    public function update($id, Request $request): object
    {
        $row = $this->model->find($id);
        $row->update($request->all());
        $class = $row->class;
        if ($class=="Drug"){
            $last_NutrientFactors=NutrientFactor::where(['drug_id'=>$row->id])->get();
            foreach ($last_NutrientFactors as $last_NutrientFactor){
                $last_NutrientFactor->delete();
            }
            foreach ($request['nutrient_factors'] as $result){
                NutrientFactor::create([
                    'drug_id'=>$row->id,
                    'result'=>$result
                ]);
            }
        }
        $rows = $this->model->where('class', $class)->latest()->get();
        return view('Dashboard.drop-down.index', compact('rows', 'class'));
    }

    public function store(Request $request): object
    {
        $row = $this->model->create($request->all());
        $class = $row->class;
        if ($class=="Drug"){
            foreach ($request['nutrient_factors'] as $result){
                NutrientFactor::create([
                   'drug_id'=>$row->id,
                   'result'=>$result
                ]);
            }
        }
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
