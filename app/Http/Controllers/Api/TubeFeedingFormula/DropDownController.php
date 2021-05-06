<?php

namespace App\Http\Controllers\Api\TubeFeedingFormula;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\DropDownCollection;
use App\Models\DropDown;

class DropDownController extends MasterController
{
    protected $model;

    public function __construct(DropDown $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function formulaNutrientsClassifications():object
    {
        return $this->sendResponse(new DropDownCollection($this->model->whereClass('FormulaNutrientsClassification')->where('parent_id',null)->get()));
    }
    public function tubeFeedings($id):object
    {
        return $this->sendResponse(new DropDownCollection($this->model->whereClass('FormulaNutrients')->where('parent_id',$id)->get()));
    }

}
