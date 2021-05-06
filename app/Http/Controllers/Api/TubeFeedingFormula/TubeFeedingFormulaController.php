<?php

namespace App\Http\Controllers\Api\TubeFeedingFormula;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\DropDownCollection;
use App\Models\DropDown;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class TubeFeedingFormulaController extends MasterController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
    }

    public function singleCalc(Request $request):object
    {
        $validator = Validator::make($request->all(),[
            'classification_id'=>'required|exists:drop_downs,id',
            'tube_feeding_id'=>'required|exists:drop_downs,id',
            'quantity'=>'required|numeric',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $arr['Dietary Fiber']=10;
        $arr['Calcium']=5;
        $arr['Fat']=.25;
        $arr['Magnesium']=25;
        $arr['Potassium']=12;
        $arr['Vitamin C']=7;
        return $this->sendResponse($arr);
    }
    public function twiceCalc(Request $request):object
    {
        $validator = Validator::make($request->all(),[
            'classification_id'=>'required|exists:drop_downs,id',
            'tube_feeding_id'=>'required|exists:drop_downs,id',
            'quantity'=>'required',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $tube_feeding_1=DropDown::find($request['tube_feeding_id'][0]);
        $tube_feeding_2=DropDown::find($request['tube_feeding_id'][1]);
        $arr_1['Dietary Fiber']=10;
        $arr_1['Calcium']=5;
        $arr_1['Fat']=.25;
        $arr_1['Magnesium']=25;
        $arr_1['Potassium']=12;
        $arr_1['Vitamin C']=7;
        $data[$tube_feeding_1->name][]=$arr_1;
        $arr_2['Dietary Fiber']=10;
        $arr_2['Calcium']=5;
        $arr_2['Fat']=.25;
        $arr_2['Magnesium']=25;
        $arr_2['Potassium']=12;
        $arr_2['Vitamin C']=7;
        $data[$tube_feeding_2->name][]=$arr_2;
        return $this->sendResponse($data);
    }

}
