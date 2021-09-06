<?php

namespace App\Imports;

use App\Models\DropDown;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ClinicalStatusImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows){
        foreach ($rows as $row) {
            if($row['name']=='' || $row['name']==null)
            {
                continue;
            }
            $data=[
                'class'=>'ClinicalStatus',
                'name'=>$row['name']
            ];
            $clinical_status=DropDown::where($data)->first();
            if(!$clinical_status){
                DropDown::create($data);
            }
        }
    }

}
