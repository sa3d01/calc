<?php

namespace App\Http\Controllers\Admin;

use App\Imports\CitiesImport;
use App\Models\DropDown;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CityController extends MasterController
{
    public function __construct(DropDown $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    public function index()
    {
        $rows = $this->model->where('class', 'City')->latest()->get();
        return view('Dashboard.city.index', compact('rows'));
    }

    public function create()
    {
        return view('Dashboard.city.create');
    }

    public function edit($id):object
    {
        $city=$this->model->find($id);
        return view('Dashboard.city.edit', compact('city'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $data['class'] = 'City';
        $this->model->create($data);
        return redirect()->route('admin.city.index')->with('created');
    }

    public function uploadExcel(Request $request)
    {
        try {
            Excel::import(new CitiesImport($request['iso_code']), $request->file('excel'));
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
        return redirect()->back()->with('created', 'تم الإضافة بنجاح');

    }

    public function update($id,Request $request)
    {
        $city=$this->model->find($id);
        $data = $request->all();
        $data['class'] = 'City';
        $city->update($data);
        return redirect()->route('admin.city.index')->with('created');
    }

    public function ban($id): object
    {
        $bank = $this->model->find($id);
        $bank->update(
            [
                'status' => 0,
            ]
        );
        $bank->refresh();
        return redirect()->back()->with('updated');
    }

    public function activate($id): object
    {
        $bank = $this->model->find($id);
        $bank->update(
            [
                'status' => 1,
            ]
        );
        $bank->refresh();
        return redirect()->back()->with('updated');
    }

}
