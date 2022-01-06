<?php

namespace App\Imports;

use App\Models\DropDown;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class CitiesImport implements ToCollection, WithHeadingRow
{
    public function  __construct($iso_code)
    {
        $this->iso_code= $iso_code;
    }
    public function collection(Collection $rows){

        foreach ($rows as $row) {
            if($row['city']=='' || $row['city']==null)
            {
                continue;
            }
            $data=[
                'class'=>'City',
                'name'=>$row['city'],
                'iso_code'=>$this->iso_code
            ];
            $city=DropDown::where($data)->first();
            if(!$city){
                DropDown::create($data);
            }
        }
    }

}
