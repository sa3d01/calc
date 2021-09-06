<?php

namespace App\Imports;

use App\Models\DropDown;
use App\Models\FormulaNutrient;
use App\Models\NutrientFactor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class FormulaNutrientsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows){
        foreach ($rows as $row) {
            if($row['formulanutrientsclassification']=='' || $row['formulanutrientsclassification']==null)
            {
                continue;
            }
            $FormulaNutrientsClassificationData=[
                'class'=>'FormulaNutrientsClassification',
                'name'=>$row['formulanutrientsclassification']
            ];
            $FormulaNutrientsClassification=DropDown::where($FormulaNutrientsClassificationData)->first();
            if(!$FormulaNutrientsClassification){
                $FormulaNutrientsClassification=DropDown::create($FormulaNutrientsClassificationData);
            }
            if($row['formulanutrients']=='' || $row['formulanutrients']==null)
            {
                continue;
            }
            $FormulaNutrientsData=[
                'class'=>'FormulaNutrients',
                'name'=>$row['formulanutrients'],
                'parent_id'=>$FormulaNutrientsClassification->id
            ];
            $FormulaNutrient=DropDown::where($FormulaNutrientsData)->first();
            if(!$FormulaNutrient){
                $FormulaNutrient=DropDown::create($FormulaNutrientsData);
            }
            if($row['volume']=='' || $row['volume']==null)
            {
                continue;
            }
            $FormulaNutrientModelData=[
                'tube_feeding_id' =>$FormulaNutrient->id,
                'volume'=>$row['volume'],
                'k_cal'=>$row['kcal'],
                'cho_g'=>$row['chog'],
                'protein_g'=>$row['proteing'],
                'fat_g'=>$row['fatg'],
                'na_mg'=>$row['namg'],
                'k_mg'=>$row['kmg'],
                'p_mg'=>$row['pmg'],
                'fiber_g'=>$row['fiberg'],
                'water_mL'=>$row['waterml'],
                'mosm'=>$row['mosm'],
            ];
            $FormulaNutrientModel=FormulaNutrient::where($FormulaNutrientModelData)->first();
            if(!$FormulaNutrientModel){
                $FormulaNutrientModel=FormulaNutrient::create($FormulaNutrientModelData);
            }

        }
    }

}
