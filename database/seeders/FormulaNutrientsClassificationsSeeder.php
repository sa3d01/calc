<?php

namespace Database\Seeders;

use App\Models\DropDown;
use Illuminate\Database\Seeder;

class FormulaNutrientsClassificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $class_1=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Standard Formula',
        ]);
        DropDown::create([
            'class'=>'FormulaNutrients',
            'parent_id'=>$class_1->id,
            'name'=>'Ensure 1.0',
        ]);
        $class_2=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Pediatric Formula',
        ]);
        DropDown::create([
            'class'=>'FormulaNutrients',
            'parent_id'=>$class_2->id,
            'name'=>'Ensure 1.0',
        ]);
        $class_3=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Renal Formula',
        ]);
        DropDown::create([
            'class'=>'FormulaNutrients',
            'parent_id'=>$class_3->id,
            'name'=>'Ensure 1.0',
        ]);
        $class_4=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Pulmonary Formula',
        ]);
        DropDown::create([
            'class'=>'FormulaNutrients',
            'parent_id'=>$class_4->id,
            'name'=>'Ensure 1.0',
        ]);
        $class_5=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Hepatic Formula',
        ]);
        DropDown::create([
            'class'=>'FormulaNutrients',
            'parent_id'=>$class_5->id,
            'name'=>'jevity 1.05',
        ]);
        $class_6=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Modular Formula',
        ]);
        DropDown::create([
            'class'=>'FormulaNutrients',
            'parent_id'=>$class_6->id,
            'name'=>'jevity 1.05',
        ]);
        $class_7=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Modular Pedia & Neonate Formula',
        ]);
        DropDown::create([
            'class'=>'FormulaNutrients',
            'parent_id'=>$class_7->id,
            'name'=>'jevity 1.05',
        ]);
        $class_8=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Critical Care Formula',
        ]);
        DropDown::create([
            'class'=>'FormulaNutrients',
            'parent_id'=>$class_8->id,
            'name'=>'jevity 1.05',
        ]);
        $class_9=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Diabetic Formula',
        ]);
        DropDown::create([
            'class'=>'FormulaNutrients',
            'parent_id'=>$class_9->id,
            'name'=>'jevity 1.05',
        ]);
        $class_10=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Fiber Formula',
        ]);
        DropDown::create([
            'class'=>'FormulaNutrients',
            'parent_id'=>$class_10->id,
            'name'=>'jevity 1.05',
        ]);
        $class_11=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Close System Formula',
        ]);
        DropDown::create([
            'class'=>'FormulaNutrients',
            'parent_id'=>$class_11->id,
            'name'=>'jevity 1.05',
        ]);
    }
}
