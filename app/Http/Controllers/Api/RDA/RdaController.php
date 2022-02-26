<?php

namespace App\Http\Controllers\Api\RDA;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\DropDownCollection;
use App\Models\DietaryAllowance;
use App\Models\DropDown;
use App\Models\NutrientFactor;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RdaController extends MasterController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
    }

    public function categories(): object
    {
        return $this->sendResponse(new DropDownCollection(DropDown::where('class', 'RdaCategory')->whereStatus(1)->where('parent_id', null)->get()));
    }

    public function ages($category_id): object
    {
        $drugs_q=DropDown::whereClass('AgeCategory')->where('parent_id',$category_id)->whereStatus(1);
        return $this->sendResponse(new DropDownCollection($drugs_q->get()));
    }

    public function calc(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'age_category_id' => 'nullable|exists:drop_downs,id',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $result=DietaryAllowance::where('age_category_id',$request['age_category_id'])->latest()->first();
        if (!$result){
            return $this->sendError('not found');
        }
        $index_fields=[
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
        ];
        $data=[];
        foreach ($index_fields as $value){
            $data[$value]=$result->$value;
        }
        return $this->sendResponse($data);
    }
}
