<?php

namespace App\Http\Controllers\Api\IdealBodyWeight;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\HealthyCaloriesRequest;
use App\Http\Requests\Api\HospitalizedCaloriesRequest;
use App\Http\Requests\Api\IdealBodyWeightRequest;
use App\Http\Resources\DropDownCollection;
use App\Models\DropDown;

class IdealBodyWeightController extends MasterController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
    }
    function BMI($weight,$height)
    {
        return $weight/($height*$height);
    }
    function weightStatus($bmi):string
    {
        if ($bmi<18.5){
            return 'UnderWeight';
        }elseif ($bmi<24.9){
            return 'Healthy Weight';
        }elseif ($bmi<29.9){
            return 'OverWeight';
        }else{
            return 'Obese';
        }
    }
    public function calc(IdealBodyWeightRequest $request)
    {
        $request->validated();
        if ($request['height']>5){
            $height=(integer)$request['height']/100;
        }else{
            $height=(integer)$request['height'];
        }
        $weight=(integer)$request['weight'];
        $bmi=$this->BMI($weight,$height);
        $arr['Status'] = $this->weightStatus($bmi);
        $arr['BMI'] = $bmi;
        $arr['ABW'] = $weight;
        if ($request['gender']=='male'){
            $ibw=24*($height*$height);
            $arr['IBW'] = $ibw;
            $arr['AjBW'] = (($weight - $ibw) * 0.25) + $ibw;
        }elseif ($request['gender']=='female'){
            $ibw=22*($height*$height);
            $arr['IBW'] = $ibw;
            $arr['AjBW'] = (($weight - $ibw) * 0.25) + $ibw;
        }else{
            $arr['IBW'] = 0;
            $arr['AjBW'] = 0;
        }
        return $this->sendResponse($arr);
    }
}
