<?php

namespace App\Http\Controllers\Api\TubeFeedingFormula;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\DropDownCollection;
use App\Models\DropDown;
use App\Models\FormulaNutrient;
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
            'quantity'=>'nullable|numeric',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $formula_nutrient=FormulaNutrient::where('tube_feeding_id',$request['tube_feeding_id'])->first();
        if (!$formula_nutrient){
            return $this->sendError('no data');
        }
        if ($request['quantity']){
            if ($request['quantity'] % $formula_nutrient->volume != 0)
            {
                return $this->sendError('quantity must be '.$formula_nutrient->volume.' or multiple of');
            }
        }
        $arr['K.cal']=$formula_nutrient->k_cal;
        $arr['CHO g']=$formula_nutrient->cho_g;
        $arr['Protein g']=$formula_nutrient->protein_g;
        $arr['Fat g']=$formula_nutrient->fat_g;
        $arr['Na mg']=$formula_nutrient->na_mg;
        $arr['K mg']=$formula_nutrient->k_mg;
        $arr['P mg']=$formula_nutrient->p_mg;
        $arr['Fiber g']=$formula_nutrient->fiber_g;
        $arr['Water mL']=$formula_nutrient->water_mL;
        $arr['mOsm']=$formula_nutrient->mosm;
        return $this->sendResponse($arr);
    }
    public function twiceCalc(Request $request):object
    {
        $validator = Validator::make($request->all(),[
            'first_classification_id'=>'required|exists:drop_downs,id',
            'second_classification_id'=>'required|exists:drop_downs,id',
            'first_tube_feeding_id'=>'required|exists:drop_downs,id',
            'second_tube_feeding_id'=>'required|exists:drop_downs,id',
            'first_quantity'=>'nullable',
            'second_quantity'=>'nullable',
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
