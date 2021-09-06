<?php

namespace App\Imports;

use App\Models\DropDown;
use App\Models\FormulaNutrient;
use App\Models\LapTest;
use App\Models\NutrientFactor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class LapTestsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows){
        foreach ($rows as $row) {
            if($row['category']=='' || $row['category']==null)
            {
                continue;
            }
            $LapTestData=[
                'class'=>'LapTest',
                'name'=>$row['category']
            ];
            $LapTest=DropDown::where($LapTestData)->first();
            if(!$LapTest){
                $LapTest=DropDown::create($LapTestData);
            }
            //
            if($row['test_name']=='' || $row['test_name']==null)
            {
                continue;
            }
            $test_nameData=[
                'class'=>'Factor',
                'name'=>$row['test_name'],
                'parent_id'=>$LapTest->id
            ];
            $test_name=DropDown::where($test_nameData)->first();
            if(!$test_name){
                $test_name=DropDown::create($test_nameData);
            }
            //
            if($row['range']=='' || $row['range']==null)
            {
                continue;
            }
            $lapTestData=[
                'factor_id' =>$test_name->id,
                'result'=>$row['range'],
            ];
            $lapTest=LapTest::where($lapTestData)->first();
            if(!$lapTest){
                $lapTest=LapTest::create($lapTestData);
            }

        }
    }

}
