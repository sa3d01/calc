<?php

namespace App\Http\Controllers\Api\TubeFeedingFormula;

use App\Http\Controllers\Api\MasterController;
use App\Models\DropDown;
use App\Models\FormulaNutrient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TubeFeedingFormulaController extends MasterController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
    }
    function dataArr($formula_nutrient,$quantity):array
    {
        $arr['name'] = $formula_nutrient->tubeFeeding->name;
        $arr['K.cal'] = $this->returnRound($formula_nutrient->k_cal / $quantity);
        $arr['CHO g'] = $this->returnRound($formula_nutrient->cho_g / $quantity);
        $arr['Protein g'] = $this->returnRound($formula_nutrient->protein_g / $quantity);
        $arr['Fat g'] = $this->returnRound($formula_nutrient->fat_g / $quantity);
        $arr['Na mg'] = $this->returnRound($formula_nutrient->na_mg / $quantity);
        $arr['K mg'] = $this->returnRound($formula_nutrient->k_mg / $quantity);
        $arr['P mg'] = $this->returnRound($formula_nutrient->p_mg / $quantity);
        $arr['Fiber g'] = $this->returnRound($formula_nutrient->fiber_g / $quantity);
        $arr['Water mL'] = $this->returnRound($formula_nutrient->water_mL / $quantity);
        $arr['mOsm'] = $this->returnRound($formula_nutrient->mosm / $quantity);
        return $arr;
    }
    public function singleCalc(Request $request): object
    {
        $validator = Validator::make($request->all(), [
            'classification_id' => 'required|exists:drop_downs,id',
            'tube_feeding_id' => 'required|exists:drop_downs,id',
            'quantity' => 'nullable|numeric',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $formula_nutrient = FormulaNutrient::where('tube_feeding_id', $request['tube_feeding_id'])->first();
        if (!$formula_nutrient) {
            return $this->sendError('no data');
        }
        $quantity = $formula_nutrient->volume;
        if ($request['quantity']) {
            $quantity = $formula_nutrient->volume / $request['quantity'];
        }
        return $this->sendResponse($this->dataArr($formula_nutrient,$quantity));
    }
    function returnRound($num):float
    {
        return round($num,2);
    }
    public function twiceCalc(Request $request): object
    {
        $validator = Validator::make($request->all(), [
            'classification_id' => 'required|exists:drop_downs,id',
            'tube_feeding_id' => 'required|exists:drop_downs,id',
            'quantity' => 'nullable',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $tube_feeding_1 = DropDown::find($request['tube_feeding_id'][0]);
        $tube_feeding_2 = DropDown::find($request['tube_feeding_id'][1]);
        $formula_nutrient_1 = FormulaNutrient::where('tube_feeding_id', $tube_feeding_1->id)->first();
        $formula_nutrient_2 = FormulaNutrient::where('tube_feeding_id', $tube_feeding_2->id)->first();
        if (!$formula_nutrient_1 || !$formula_nutrient_2) {
            return $this->sendError('no data');
        }
        $quantity_1 = $formula_nutrient_1->volume;
        $quantity_2 = $formula_nutrient_2->volume;
        if ($request['quantity']) {
            $quantity_1 = $formula_nutrient_1->volume / $request['quantity'][0];
            $quantity_2 = $formula_nutrient_2->volume / $request['quantity'][1];
        }
        $arr_1=$this->dataArr($formula_nutrient_1,$quantity_1);
        $arr_1['name'] = $tube_feeding_1->name;
        $data[] = $arr_1;
        $arr_2=$this->dataArr($formula_nutrient_2,$quantity_2);
        $arr_2['name'] = $tube_feeding_2->name;
        $data[] = $arr_2;
        return $this->sendResponse($data);
    }
}
