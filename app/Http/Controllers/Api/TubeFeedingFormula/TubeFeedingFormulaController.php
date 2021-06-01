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
        $quantity=$formula_nutrient->volume;
        if ($request['quantity']){
//            if ($request['quantity'] % $formula_nutrient->volume != 0)
//            {
//                return $this->sendError('quantity must be '.$formula_nutrient->volume.' or multiple of');
//            }
            $quantity=$formula_nutrient->volume/$request['quantity'];
        }
        $arr['name']=$formula_nutrient->tubeFeeding->name;
        $arr['K.cal']=$formula_nutrient->k_cal/$quantity;
        $arr['CHO g']=$formula_nutrient->cho_g/$quantity;
        $arr['Protein g']=$formula_nutrient->protein_g/$quantity;
        $arr['Fat g']=$formula_nutrient->fat_g/$quantity;
        $arr['Na mg']=$formula_nutrient->na_mg/$quantity;
        $arr['K mg']=$formula_nutrient->k_mg/$quantity;
        $arr['P mg']=$formula_nutrient->p_mg/$quantity;
        $arr['Fiber g']=$formula_nutrient->fiber_g/$quantity;
        $arr['Water mL']=$formula_nutrient->water_mL/$quantity;
        $arr['mOsm']=$formula_nutrient->mosm/$quantity;
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

        $formula_nutrient_1=FormulaNutrient::where('tube_feeding_id',$tube_feeding_1->id)->first();
        $formula_nutrient_2=FormulaNutrient::where('tube_feeding_id',$tube_feeding_2->id)->first();
        if (!$formula_nutrient_1 || !$formula_nutrient_2){
            return $this->sendError('no data');
        }
        $quantity_1=$formula_nutrient_1->volume;
        $quantity_2=$formula_nutrient_2->volume;
        if ($request['quantity']){
//            if (($request['quantity'][0] % $formula_nutrient_1->volume != 0) || ($request['quantity'][1] % $formula_nutrient_2->volume != 0))
//            {
//                return $this->sendError('quantity must be '.$formula_nutrient_1->volume.' or multiple of');
//            }
            $quantity_1=$formula_nutrient_1->volume/$request['quantity'][0];
            $quantity_2=$formula_nutrient_2->volume/$request['quantity'][1];
        }
        $arr_1['name']=$tube_feeding_1->name;
        $arr_1['K.cal']=$formula_nutrient_1->k_cal/$quantity_1;
        $arr_1['CHO g']=$formula_nutrient_1->cho_g/$quantity_1;
        $arr_1['Protein g']=$formula_nutrient_1->protein_g/$quantity_1;
        $arr_1['Fat g']=$formula_nutrient_1->fat_g/$quantity_1;
        $arr_1['Na mg']=$formula_nutrient_1->na_mg/$quantity_1;
        $arr_1['K mg']=$formula_nutrient_1->k_mg/$quantity_1;
        $arr_1['P mg']=$formula_nutrient_1->p_mg/$quantity_1;
        $arr_1['Fiber g']=$formula_nutrient_1->fiber_g/$quantity_1;
        $arr_1['Water mL']=$formula_nutrient_1->water_mL/$quantity_1;
        $arr_1['mOsm']=$formula_nutrient_1->mosm/$quantity_1;
        $data[]=$arr_1;
        $arr_2['name']=$tube_feeding_2->name;
        $arr_2['K.cal']=$formula_nutrient_2->k_cal/$quantity_2;
        $arr_2['CHO g']=$formula_nutrient_2->cho_g/$quantity_2;
        $arr_2['Protein g']=$formula_nutrient_2->protein_g/$quantity_2;
        $arr_2['Fat g']=$formula_nutrient_2->fat_g/$quantity_2;
        $arr_2['Na mg']=$formula_nutrient_2->na_mg/$quantity_2;
        $arr_2['K mg']=$formula_nutrient_2->k_mg/$quantity_2;
        $arr_2['P mg']=$formula_nutrient_2->p_mg/$quantity_2;
        $arr_2['Fiber g']=$formula_nutrient_2->fiber_g/$quantity_2;
        $arr_2['Water mL']=$formula_nutrient_2->water_mL/$quantity_2;
        $arr_2['mOsm']=$formula_nutrient_2->mosm/$quantity_2;
        $data[]=$arr_2;
        return $this->sendResponse($data);
    }

}
