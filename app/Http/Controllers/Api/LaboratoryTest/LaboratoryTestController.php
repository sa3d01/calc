<?php

namespace App\Http\Controllers\Api\LaboratoryTest;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\DropDownCollection;
use App\Models\DropDown;
use App\Models\FormulaNutrient;
use App\Models\LapTest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class LaboratoryTestController extends MasterController
{
    protected $model;

    public function __construct()
    {
        parent::__construct();
    }

    public function types():object
    {
        return $this->sendResponse(new DropDownCollection(DropDown::where('class','LapTest')->whereStatus(1)->where('parent_id',null)->get()));
    }
    public function factors($id):object
    {
        return $this->sendResponse(new DropDownCollection(DropDown::whereClass('Factor')->whereStatus(1)->where('parent_id',$id)->get()));
    }
    public function calc(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'type_id'=>'required|exists:drop_downs,id',
            'factor_id'=>'required|exists:drop_downs,id',
        ]);
        if ($validator->fails()) {
            return $this->sendError($validator->errors()->first());
        }
        $result=LapTest::where('factor_id',$request['factor_id'])->first();
        if (!$result){
            return $this->sendError('no data');
        }
        $up=LapTest::where('factor_id',$request['factor_id'])->pluck('up');
        $up = array_map(function($v){
            return (is_null($v)) ? "" : $v;
        },$up);

        $down=LapTest::where('factor_id',$request['factor_id'])->pluck('dwon');
        $down = array_map(function($v){
            return (is_null($v)) ? "" : $v;
        },$down);


        $response = [
            'status' => 200,
            'message' =>  '',
            'data' => LapTest::where('factor_id',$request['factor_id'])->pluck('result'),
            'up'=>$up,
            'down'=>$down
        ];
        return response()->json($response);
    }
}
