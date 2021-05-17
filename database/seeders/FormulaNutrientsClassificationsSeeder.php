<?php

namespace Database\Seeders;

use App\Models\DropDown;
use App\Models\FormulaNutrient;
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
        $sub_1=DropDown::create([
            'class'=>'FormulaNutrients',
            'parent_id'=>$class_1->id,
            'name'=>'Ensure 1.0',
        ]);
        $sub_2=DropDown::create([
            'class'=>'FormulaNutrients',
            'parent_id'=>$class_1->id,
            'name'=>'jevity 1.05',
        ]);
        FormulaNutrient::create([
           'tube_feeding_id'=>$sub_1->id,
           'volume'=>'200',
           'k_cal'=>'201',
            'cho_g'=>'27.12',
            'protein_g'=>'8',
            'fat_g'=>'6.72',
            'na_mg'=>'176',
            'k_mg'=>'296',
            'p_mg'=>'124',
            'fiber_g'=>'0',
            'water_mL'=>'170',
            'mosm'=>'319',
        ]);
        FormulaNutrient::create([
           'tube_feeding_id'=>$sub_2->id,
           'volume'=>'237',
           'k_cal'=>'250',
            'cho_g'=>'36.5',
            'protein_g'=>'10.4',
            'fat_g'=>'8.2',
            'na_mg'=>'220',
            'k_mg'=>'370',
            'p_mg'=>'180',
            'fiber_g'=>'3.6',
            'water_mL'=>'197',
            'mosm'=>'300',
        ]);
        $class_2=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Pediatric Formula',
        ]);
//        DropDown::create([
//            'class'=>'FormulaNutrients',
//            'parent_id'=>$class_2->id,
//            'name'=>'Ensure 1.0',
//        ]);
        $class_3=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Renal Formula',
        ]);
//        DropDown::create([
//            'class'=>'FormulaNutrients',
//            'parent_id'=>$class_3->id,
//            'name'=>'Ensure 1.0',
//        ]);
        $class_4=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Pulmonary Formula',
        ]);
//        DropDown::create([
//            'class'=>'FormulaNutrients',
//            'parent_id'=>$class_4->id,
//            'name'=>'Ensure 1.0',
//        ]);
        $class_5=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Hepatic Formula',
        ]);
//        DropDown::create([
//            'class'=>'FormulaNutrients',
//            'parent_id'=>$class_5->id,
//            'name'=>'jevity 1.05',
//        ]);
        $class_6=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Modular Formula',
        ]);
//        DropDown::create([
//            'class'=>'FormulaNutrients',
//            'parent_id'=>$class_6->id,
//            'name'=>'jevity 1.05',
//        ]);
        $class_7=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Modular Pedia & Neonate Formula',
        ]);
//        DropDown::create([
//            'class'=>'FormulaNutrients',
//            'parent_id'=>$class_7->id,
//            'name'=>'jevity 1.05',
//        ]);
        $class_8=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Critical Care Formula',
        ]);
//        DropDown::create([
//            'class'=>'FormulaNutrients',
//            'parent_id'=>$class_8->id,
//            'name'=>'jevity 1.05',
//        ]);
        $class_9=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Diabetic Formula',
        ]);
//        DropDown::create([
//            'class'=>'FormulaNutrients',
//            'parent_id'=>$class_9->id,
//            'name'=>'jevity 1.05',
//        ]);
        $class_10=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Fiber Formula',
        ]);
//        DropDown::create([
//            'class'=>'FormulaNutrients',
//            'parent_id'=>$class_10->id,
//            'name'=>'jevity 1.05',
//        ]);
        $class_11=DropDown::create([
            'class'=>'FormulaNutrientsClassification',
            'name'=>'Close System Formula',
        ]);
//        DropDown::create([
//            'class'=>'FormulaNutrients',
//            'parent_id'=>$class_11->id,
//            'name'=>'jevity 1.05',
//        ]);
    }
}
