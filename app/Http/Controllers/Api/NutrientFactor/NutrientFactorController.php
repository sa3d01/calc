<?php

namespace App\Http\Controllers\Api\NutrientFactor;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\DropDownCollection;
use App\Models\DropDown;
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

    public function drugs(): object
    {
        $drugs_q=DropDown::whereClass('Drug');
        if (\request()->input('drug')){
            $drugs_q=$drugs_q->where('name','LIKE','%'.\request()->input('drug').'%');
        }
        return $this->sendResponse(new DropDownCollection($drugs_q->get()));
    }

    public function calc(Request $request)
    {
        $validator = Validator::make($request->all(), [
//            'nutrient_id' => 'nullable|exists:drop_downs,id',
            'drug_id' => 'nullable|exists:drop_downs,id',
//            'drug_name' => 'nullable|exists:drop_downs,name',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        if ($request->has('drug_id')){
            $result = NutrientFactor::where('drug_id', $request['drug_id'])->first();
        }else{
            $drug=DropDown::whereClass('Drug')->where('name','LIKE','%'.$request['drug_name'].'%')->first();
            if (!$drug){
                return $this->sendError('no data');
            }
            $result = NutrientFactor::where('drug_id', $drug->id)->first();
        }
        if (!$result) {
            return $this->sendError('no data');
        }
        $data['results']=NutrientFactor::where('drug_id', $request['drug_id'])->pluck('result');
        $data['resources']=Resource::pluck('name');
        return $this->sendResponse($data);
    }
}
