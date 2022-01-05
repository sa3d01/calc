<?php

namespace App\Imports;

use App\Models\DropDown;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class CountriesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows){
        foreach ($rows as $row) {
            if($row['country']=='' || strlen($row['country'])<3)
            {
                continue;
            }
            $data=[
                'class'=>'Country',
                'name'=>$row['country'],
                'iso_code'=>$row['country_code']
            ];
            $country=DropDown::where($data)->first();
            if(!$country){
                DropDown::create($data);
            }
        }
    }

}
