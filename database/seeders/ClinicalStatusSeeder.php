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
        DropDown::create([
            'class'=>'ClinicalStatus',
            'name'=>'Fever',
        ]);
        DropDown::create([
            'class'=>'ClinicalStatus',
            'name'=>'elective surgery',
        ]);
        DropDown::create([
            'class'=>'ClinicalStatus',
            'name'=>'multiple trauma',
        ]);
        DropDown::create([
            'class'=>'ClinicalStatus',
            'name'=>'severe infection',
        ]);

    }
}
