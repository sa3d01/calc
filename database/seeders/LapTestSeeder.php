<?php

namespace Database\Seeders;

use App\Models\DropDown;
use App\Models\FormulaNutrient;
use App\Models\LapTest;
use Illuminate\Database\Seeder;

class LapTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $test_1=DropDown::create([
            'class'=>'LapTest',
            'name'=>'Basic Metabolic Panel (BMP)',
        ]);
        $factor_1=DropDown::create([
            'class'=>'Factor',
            'parent_id'=>$test_1->id,
            'name'=>'Glucose',
        ]);
        LapTest::create([
           'factor_id' =>$factor_1->id,
            'result'=>"Fasting: 70 – 110 mg/dl (3.9 mmol/L – 5.6 mmol/L)"
        ]);
        LapTest::create([
           'factor_id' =>$factor_1->id,
            'result'=>"Random: 80 – 11mg/dl (7.8 mmol/L – 11.1 mmol/L)"
        ]);
        LapTest::create([
           'factor_id' =>$factor_1->id,
            'result'=>"HbA1c < 6.0%"
        ]);
        $factor_2=DropDown::create([
            'class'=>'Factor',
            'parent_id'=>$test_1->id,
            'name'=>'Calcium ( Ca )',
        ]);
        LapTest::create([
            'factor_id' =>$factor_2->id,
            'result'=>"8.5 - 10.5 mg/dl (2.2 – 2.7 mmol/L)"
        ]);
        $factor_3=DropDown::create([
            'class'=>'Factor',
            'parent_id'=>$test_1->id,
            'name'=>'Sodium ( Na )',
        ]);
        LapTest::create([
            'factor_id' =>$factor_3->id,
            'result'=>"135 – 145 mEq/L (135 mmol/L – 145 mmol/L)"
        ]);
        $test_2=DropDown::create([
            'class'=>'LapTest',
            'name'=>'Complete Blood Count (CBC)',
        ]);
        $factor_1=DropDown::create([
            'class'=>'Factor',
            'parent_id'=>$test_2->id,
            'name'=>'Red Blood Cells ( RBCs ) ; Erythrocyte Count',
        ]);
        LapTest::create([
            'factor_id' =>$factor_1->id,
            'result'=>"RBC x 106 μlor RBC x 1012 /L"
        ]);
        LapTest::create([
            'factor_id' =>$factor_1->id,
            'result'=>"Male: 4.7 – 6.1"
        ]);
        LapTest::create([
            'factor_id' =>$factor_1->id,
            'result'=>"Female: 4.2 – 5.4"
        ]);
        $factor_2=DropDown::create([
            'class'=>'Factor',
            'parent_id'=>$test_2->id,
            'name'=>'Hemoglobin',
        ]);
        LapTest::create([
            'factor_id' =>$factor_2->id,
            'result'=>"Male: 14 – 18 g/dl ( 8.7 mmol/L – 11.2 mmol/L )"
        ]);
        LapTest::create([
            'factor_id' =>$factor_2->id,
            'result'=>"Female:12 – 16 g/dl ( 7.4 mmol/L - 9.9 mmol/L )"
        ]);
        $factor_3=DropDown::create([
            'class'=>'Factor',
            'parent_id'=>$test_2->id,
            'name'=>'Hematocrit (HCT) ; Packed Cell Volume ( PCV)',
        ]);
        LapTest::create([
            'factor_id' =>$factor_3->id,
            'result'=>"Male: 42% - 52% (0.42 – 0.52 volume fraction)"
        ]);
        LapTest::create([
            'factor_id' =>$factor_3->id,
            'result'=>"Female: 37% - 47% (0.37 – 0.47 volume fraction)"
        ]);

    }
}
