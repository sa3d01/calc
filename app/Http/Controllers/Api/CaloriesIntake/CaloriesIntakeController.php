<?php

namespace App\Http\Controllers\Api\CaloriesIntake;

use App\Http\Controllers\Api\MasterController;
use App\Http\Requests\Api\HealthyCaloriesRequest;
use App\Http\Requests\Api\HospitalizedCaloriesRequest;
use App\Http\Resources\DropDownCollection;
use App\Models\DropDown;

class CaloriesIntakeController extends MasterController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
    }

    public function ClinicalStatus(): object
    {
        return $this->sendResponse(new DropDownCollection(DropDown::whereClass('ClinicalStatus')->where('parent_id', null)->get()));
    }

    public function healthyCalc(HealthyCaloriesRequest $request): object
    {
        $request->validated();
        $arr['BMR'] = 1.2;
        $arr['Total'] = 1.52;
        return $this->sendResponse($arr);
    }

    public function hospitalizedCalc(HospitalizedCaloriesRequest $request): object
    {
        $request->validated();
        $arr['BMR'] = 1.2;
        $arr['Total'] = 1.52;
        return $this->sendResponse($arr);
    }


}
