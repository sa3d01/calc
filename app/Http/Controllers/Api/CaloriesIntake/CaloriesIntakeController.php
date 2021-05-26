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
    function BMRForMen($weight,$height,$age):int
    {
        return 66.5 + ( 13.75 * $weight ) + ( 5.003 * $height ) - ( 6.755 * $age );
    }
    function BMRForWomen($weight,$height,$age):int
    {
        return 655 + ( 9.563 * $weight) + ( 1.850 * $height ) - ( 4.676 * $age );
    }
    function TotalEnergyForHealthy($activity_factor,$bmr):int
    {
        switch ($activity_factor){
            case "Very Active":
                $total_energy=1.725 * $bmr;
                break;
            case "Extremely Active":
                $total_energy=1.9 * $bmr;
                break;
            case "Moderately Active":
                $total_energy=1.55 * $bmr;
                break;
            case "Lightly Active":
                $total_energy=1.375 * $bmr;
                break;
            default:
                $total_energy=1.2 * $bmr;
        }
        return $total_energy;
    }
    function TotalEnergyForHospitalized($activity_factor,$bmr):int
    {
        switch ($activity_factor){
            case "OverWeight"||"Obese":
                $total_energy=1.1 * $bmr;
                break;
            case "UnderWeight"||"Normal":
                $total_energy=1.2 * $bmr;
                break;
            default:
                $total_energy=1.3 * $bmr;
        }
        return $total_energy;
    }
    public function healthyCalc(HealthyCaloriesRequest $request): object
    {
        $request->validated();
        $weight=$request['weight'];
        $height=$request['height'];
        $age=$request['age'];
        if ($request['gender']=='male')
        {
            $bmr=$this->BMRForMen($weight,$height,$age);
        }else{
            $bmr=$this->BMRForWomen($weight,$height,$age);
        }
        $arr['BMR'] = $bmr;
        if ($request['activity_factor']){
            $total_energy=$this->TotalEnergyForHealthy($request['activity_factor'],$bmr);
            $arr['Total'] = $total_energy;
        }else{
            $arr['Total'] = 0;
        }
        return $this->sendResponse($arr);
    }

    public function hospitalizedCalc(HospitalizedCaloriesRequest $request): object
    {
        $request->validated();
        $weight=$request['weight'];
        $height=$request['height'];
        $age=$request['age'];
        if ($request['gender']=='male')
        {
            $bmr=$this->BMRForMen($weight,$height,$age);
        }else{
            $bmr=$this->BMRForWomen($weight,$height,$age);
        }
        $total_energy=$this->TotalEnergyForHospitalized($request['activity_factor'],$bmr);
        $clinical_status=DropDown::find($request['clinical_status_id']);
        $stress_factor=$request['stress_factor'];
        if (!$request->has('stress_factor')){
            if ($clinical_status->name=='elective surgery'){
                $stress_factor=rand(1,1.2);
            }elseif ($clinical_status=='multiple trauma' || $clinical_status=='severe infection'){
                $stress_factor=rand(1.2,1.6);
            }elseif ($clinical_status=='Multiple /long done fractures'){
                $stress_factor=rand(1.1,1.3);
            }elseif ($clinical_status=='Infection with trauma'){
                $stress_factor=rand(1.3,1.5);
            }elseif ($clinical_status=='Sepsis'){
                $stress_factor=rand(1.2,1.4);
            }elseif ($clinical_status=='Closed head injury'){
                $stress_factor=1.3;
            }elseif ($clinical_status=='Cancer'){
                $stress_factor=rand(1.1,1.45);
            }elseif ($clinical_status=='Burns'){
                $stress_factor=rand(1,2.5);
            }else{
                $stress_factor=2.4;
            }
        }
        $arr['BMR'] = $bmr;
        $arr['Total'] = $total_energy*$stress_factor;
        return $this->sendResponse($arr);
    }


}
