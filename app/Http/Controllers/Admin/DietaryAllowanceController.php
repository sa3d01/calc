<?php

namespace App\Http\Controllers\Admin;

use App\Models\DietaryAllowance;
use Illuminate\Http\Request;

class DietaryAllowanceController extends MasterController
{
    public function __construct(DietaryAllowance $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function DietaryAllowance($age_category_id)
    {
        $rows = $this->model->where('age_category_id', $age_category_id)->latest()->get();
        return View('Dashboard.dietary_allowance.index', [
            'rows' => $rows,
            'age_category_id'=>$age_category_id,
            'index_fields'=>[
                'Sodium',
                'Potassium',
                'Calcium',
                'Phosphorus',
                'Magnesium',
                'Iron',
                'Zinc',
                'Iodine',
                'Selenium',
                'Copper',
                'Chloride',
                'Chromium',
                'Fluoride',
                'Vitamin_A',
                'Vitamin_C',
                'Vitamin_D',
                'Vitamin_E',
                'Vitamin_K',
                'Vitamin_B12',
                'Thiamin',
                'Riboflavin',
                'Niacin',
                'Vitamin_B6',
                'Folate',
                'Biotin',
                'Pantothenic_Acid',
            ],
        ]);
    }

    public function DietaryAllowanceCreate($age_category_id)
    {
        return View('Dashboard.dietary_allowance.create', [
            'age_category_id'=>$age_category_id,
            'index_fields'=>[
                'Sodium',
                'Potassium',
                'Calcium',
                'Phosphorus',
                'Magnesium',
                'Iron',
                'Zinc',
                'Iodine',
                'Selenium',
                'Copper',
                'Chloride',
                'Chromium',
                'Fluoride',
                'Vitamin_A',
                'Vitamin_C',
                'Vitamin_D',
                'Vitamin_E',
                'Vitamin_K',
                'Vitamin_B12',
                'Thiamin',
                'Riboflavin',
                'Niacin',
                'Vitamin_B6',
                'Folate',
                'Biotin',
                'Pantothenic_Acid',
            ],
        ]);
    }

    public function DietaryAllowanceEdit($id): object
    {
        $row = $this->model->find($id);
        return View('Dashboard.dietary_allowance.edit', [
            'row'=>$row,
            'index_fields'=>[
                'Sodium',
                'Potassium',
                'Calcium',
                'Phosphorus',
                'Magnesium',
                'Iron',
                'Zinc',
                'Iodine',
                'Selenium',
                'Copper',
                'Chloride',
                'Chromium',
                'Fluoride',
                'Vitamin_A',
                'Vitamin_C',
                'Vitamin_D',
                'Vitamin_E',
                'Vitamin_K',
                'Vitamin_B12',
                'Thiamin',
                'Riboflavin',
                'Niacin',
                'Vitamin_B6',
                'Folate',
                'Biotin',
                'Pantothenic_Acid',
            ],
        ]);
    }

    public function DietaryAllowanceUpdate($id, Request $request): object
    {
        $row = $this->model->find($id);
        $row->update($request->all());
        return redirect()->back();
        $age_category_id = $row->age_category_id;
        $rows = $this->model->where('age_category_id', $age_category_id)->latest()->get();
        return view('Dashboard.dietary_allowance.index', compact('rows', 'age_category_id'));
    }

    public function DietaryAllowanceStore(Request $request): object
    {
        $row = $this->model->create($request->all());
        return redirect()->back();

        $age_category_id = $row->age_category_id;
        $rows = $this->model->where('age_category_id', $age_category_id)->latest()->get();
        return view('Dashboard.dietary_allowance.index', compact('rows', 'age_category_id'));
    }


}
