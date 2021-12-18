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
        return $this->sendResponse(new DropDownCollection(DropDown::whereClass('ClinicalStatus')->where('parent_id', null)->whereStatus(1)->get()));
    }
    function BMRForMen($weight,$height,$age):int
    {
        return 66.5 + ( 13.75 * $weight ) + ( 5.003 * $height ) - ( 6.755 * $age );
    }
    function BMRForWomen($weight,$height,$age):int
    {
        return 655 + ( 9.563 * $weight) + ( 1.850 * $height ) - ( 4.676 * $age );
    }
    function TotalEnergyForHealthy($activity_factor,$bmr)
    {
        if ($activity_factor=="Very active"){
            $total_energy=1.725 * $bmr;
        }elseif ($activity_factor=="Extremely active"){
            $total_energy=1.9 * $bmr;
        }elseif ($activity_factor=="Moderately active"){
            $total_energy=1.55 * $bmr;
        }elseif ($activity_factor=="Light active"){
            $total_energy=1.375 * $bmr;
        }else{
            $total_energy=1.2 * $bmr;
        }
        return $total_energy;
    }
    function TotalEnergyForHospitalized($activity_factor,$bmr):float
    {
        if ($activity_factor==="OverWeight" || $activity_factor==="Obese"){
            $total_energy=1.1 * $bmr;
        }elseif ($activity_factor==="UnderWeight" || $activity_factor==="Normal"){
            $total_energy=1.2 * $bmr;
        }else{
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
    public function hospitalizedCalc(HospitalizedCaloriesRequest $request)
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
        if ($request['activity_factor']){
            $total_energy=$this->TotalEnergyForHospitalized($request['activity_factor'],$bmr);
            if ($request['clinical_status_id']){
                $clinical_status=DropDown::find($request['clinical_status_id']);
                $stress_factor=$request['stress_factor'];
                if (!$request->has('stress_factor')){
                    // if ($clinical_status->name=='Elective surgery'){
                    //     $stress_factor=rand(1,1.2);
                    // }elseif ($clinical_status->name=='Multiple trauma' || $clinical_status->name=='Severe infection'){
                    //     $stress_factor=rand(1.2,1.6);
                    // }elseif ($clinical_status->name=='Multiple /long done fractures'){
                    //     $stress_factor=rand(1.1,1.3);
                    // }elseif ($clinical_status->name=='Infection with trauma'){
                    //     $stress_factor=rand(1.3,1.5);
                    // }elseif ($clinical_status->name=='Sepsis'){
                    //     $stress_factor=rand(1.2,1.4);
                    // }elseif ($clinical_status->name=='Closed head injury'){
                    //     $stress_factor=1.3;
                    // }elseif ($clinical_status->name=='Cancer'){
                    //     $stress_factor=rand(1.1,1.45);
                    // }elseif ($clinical_status->name=='Burns'){
                    //     $stress_factor=rand(1,2.5);
                    // }else{
                    //     $stress_factor=2.4;
                    // }
                    if($clinical_status->stress_factor_to!=null){
                        $stress_factor=rand($clinical_status->stress_factor_from,$clinical_status->stress_factor_to);
                    }else{
                        $stress_factor=$clinical_status->stress_factor_from??2.4;
                    }
                }elseif ($clinical_status->name=='Fever'){
                    $stress_factor_count=$stress_factor-37;
                    $stress_factor=1.2;
                    for($i=0;$i<$stress_factor_count;$i++){
                        $stress_factor=$stress_factor+1.2;
                    }
                }
            }else{
                $stress_factor=1;
            }
            $arr['Total'] =round($total_energy*$stress_factor,2);
        }else{
            $arr['Total'] = 0;
        }
        $arr['BMR'] = $bmr;
        return $this->sendResponse($arr);
    }
}
