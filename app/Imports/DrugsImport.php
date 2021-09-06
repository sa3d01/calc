<?php

namespace App\Imports;

use App\Models\DropDown;
use App\Models\NutrientFactor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class DrugsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows){
        foreach ($rows as $row) {
            if($row['category']=='' || $row['category']==null)
            {
                continue;
            }
            $category_data=[
                'class'=>'Nutrient',
                'name'=>$row['category']
            ];
            $Nutrient=DropDown::where($category_data)->first();
            if(!$Nutrient){
                $Nutrient=DropDown::create($category_data);
            }
            if($row['drug']=='' || $row['drug']==null)
            {
                continue;
            }
            $drug_data=[
                'class'=>'Drug',
                'name'=>$row['drug'],
                'parent_id'=>$Nutrient->id
            ];
            $drug=DropDown::where($drug_data)->first();
            if(!$drug){
                $drug=DropDown::create($drug_data);
            }
            if($row['interaction']=='' || $row['interaction']==null)
            {
                continue;
            }
            $NutrientFactor_data=[
                'result'=>$row['interaction'],
                'drug_id'=>$drug->id
            ];
            $NutrientFactor=NutrientFactor::where($NutrientFactor_data)->first();
            if(!$NutrientFactor){
                $NutrientFactor=NutrientFactor::create($NutrientFactor_data);
            }
        }
    }

}
