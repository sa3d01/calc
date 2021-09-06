<?php

namespace App\Http\Controllers\Api\General;

use App\Http\Controllers\Api\MasterController;
use App\Http\Resources\DropDownCollection;
use App\Imports\ClinicalStatusImport;
use App\Imports\DrugsImport;
use App\Imports\FormulaNutrientsImport;
use App\Imports\LapTestsImport;
use App\Models\DropDown;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class DropDownController extends MasterController
{
    protected $model;
    public function __construct(DropDown $model)
    {
        $this->model = $model;
        parent::__construct();
    }
    public function cities()
    {
        return $this->sendResponse(new DropDownCollection($this->model->whereClass('City')->whereStatus(1)->get()));
    }
    public function uploadClinicalStatus(Request $request)
    {
        Excel::import(new ClinicalStatusImport(), $request->file('excel'));
        return redirect()->back()->with('success', 'All good!');
    }
    public function uploadDrugs(Request $request)
    {
        Excel::import(new DrugsImport(), $request->file('excel'));
        return redirect()->back()->with('success', 'All good!');
    }
    public function uploadFormulanutrients(Request $request)
    {
        Excel::import(new FormulaNutrientsImport(), $request->file('excel'));
        return redirect()->back()->with('success', 'All good!');
    }
    public function uploadLapTests(Request $request)
    {
        Excel::import(new LapTestsImport(), $request->file('excel'));
        return redirect()->back()->with('success', 'All good!');
    }

}
