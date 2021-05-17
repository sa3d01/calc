<?php

namespace App\Http\Controllers\Api\NutrientFactor;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\DropDownCollection;
use App\Models\DropDown;
use App\Models\LapTest;
use App\Models\NutrientFactor;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NutrientFactorController extends MasterController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
    }

    public function nutrients(): object
    {
        return $this->sendResponse(new DropDownCollection(DropDown::where('class', 'Nutrient')->where('parent_id', null)->get()));
    }

    public function drugs($id): object
    {
        return $this->sendResponse(new DropDownCollection(DropDown::whereClass('Drug')->where('parent_id', $id)->get()));
    }

    public function calc(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nutrient_id' => 'required|exists:drop_downs,id',
            'drug_id' => 'required|exists:drop_downs,id',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $result = NutrientFactor::where('drug_id', $request['drug_id'])->first();
        if (!$result) {
            return $this->sendError('no data');
        }
        $data['results']=NutrientFactor::where('drug_id', $request['drug_id'])->pluck('result');
        $data['resources']=Resource::pluck('name');
        return $this->sendResponse($data);
    }
}
