<?php

namespace Database\Seeders;

use App\Models\DropDown;
use App\Models\FormulaNutrient;
use App\Models\LapTest;
use App\Models\NutrientFactor;
use Illuminate\Database\Seeder;

class NutrientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nutrient_1=DropDown::create([
            'class'=>'Nutrient',
            'name'=>'Diuretics',
        ]);
        $drug_1=DropDown::create([
            'class'=>'Drug',
            'parent_id'=>$nutrient_1->id,
            'name'=>'Furosemide',
        ]);
        NutrientFactor::create([
           'drug_id'=>$drug_1->id,
           'result'=>'Monitor Potassium levels and intake'
        ]);
        NutrientFactor::create([
           'drug_id'=>$drug_1->id,
           'result'=>'Inhibits reabsorption of sodium.'
        ]);
        NutrientFactor::create([
           'drug_id'=>$drug_1->id,
           'result'=>'Used asdiureticand Antihypertensive agent'
        ]);
        $drug_2=DropDown::create([
            'class'=>'Drug',
            'parent_id'=>$nutrient_1->id,
            'name'=>'Indapamide',
        ]);
        NutrientFactor::create([
            'drug_id'=>$drug_2->id,
            'result'=>'Absorption is decreased with meals or tube feeding'
        ]);
        NutrientFactor::create([
            'drug_id'=>$drug_2->id,
            'result'=>'Monitor Potassium levels and intake'
        ]);
        NutrientFactor::create([
            'drug_id'=>$drug_2->id,
            'result'=>'Used as diureticand Antihypertensive agent.'
        ]);
        $drug_3=DropDown::create([
            'class'=>'Drug',
            'parent_id'=>$nutrient_1->id,
            'name'=>'Triamterene',
        ]);
        NutrientFactor::create([
            'drug_id'=>$drug_3->id,
            'result'=>'Monitor Potassium levels and intake'
        ]);
        NutrientFactor::create([
            'drug_id'=>$drug_3->id,
            'result'=>'Inhibits reabsorption of sodium& potassium excretion'
        ]);
        NutrientFactor::create([
            'drug_id'=>$drug_3->id,
            'result'=>'Used as diureticand Antihypertensive agent'
        ]);


    }
}
