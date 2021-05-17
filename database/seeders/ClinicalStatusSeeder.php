<?php

namespace Database\Seeders;

use App\Models\DropDown;
use Illuminate\Database\Seeder;

class ClinicalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //1-1.2
        DropDown::create([
            'class'=>'ClinicalStatus',
            'name'=>'Elective surgery',
        ]);
        //1.2-1.6
        DropDown::create([
            'class'=>'ClinicalStatus',
            'name'=>'Multiple trauma',
        ]);
        //1.2-1.6
        DropDown::create([
            'class'=>'ClinicalStatus',
            'name'=>'Severe infection',
        ]);
        //1.1-1.3
        DropDown::create([
            'class'=>'ClinicalStatus',
            'name'=>'Multiple /long done fractures',
        ]);
        //1.3-1.5
        DropDown::create([
            'class'=>'ClinicalStatus',
            'name'=>'Infection with trauma',
        ]);
        //1.2-1.4
        DropDown::create([
            'class'=>'ClinicalStatus',
            'name'=>'Sepsis',
        ]);
        //1.3
        DropDown::create([
            'class'=>'ClinicalStatus',
            'name'=>'Closed head injury',
        ]);
        //1.1-1.45
        DropDown::create([
            'class'=>'ClinicalStatus',
            'name'=>'Cancer',
        ]);
        //1-2.5
        DropDown::create([
            'class'=>'ClinicalStatus',
            'name'=>'Burns',
        ]);
        //2.4
        DropDown::create([
            'class'=>'ClinicalStatus',
            'name'=>'Fever',
        ]);

    }
}
