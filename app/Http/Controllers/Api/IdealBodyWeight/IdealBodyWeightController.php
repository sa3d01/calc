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
    function BMI($request)
    {
        return round($request['weight']/$request['height'],2);
    }
    function weightStatus($BMI):string
    {
        if ($BMI<18.5){
            return 'UnderWeight';
        }elseif ($BMI<24.9){
            return 'Healthy Weight';
        }elseif ($BMI<29.9){
            return 'OverWeight';
        }else{
            return 'Obese';
        }
    }
    public function calc(IdealBodyWeightRequest $request): object
    {
        $request->validated();
        $BMI=$this->BMI($request);
        $arr['Status'] = $this->weightStatus($BMI);
        $arr['BMI'] = $BMI;
        $arr['ABW'] = 58;
        $arr['IBW'] = 60;
        return $this->sendResponse($arr);
    }
}
