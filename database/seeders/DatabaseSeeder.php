<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            SettingSeeder::class,
            CitySeeder::class,
            SliderSeeder::class,
            ContactTypeSeeder::class,
            UserSeeder::class,
            FormulaNutrientsClassificationsSeeder::class,
            ClinicalStatusSeeder::class,
            LapTestSeeder::class,
            NutrientsSeeder::class,
            ResourceSeeder::class
        ]);
    }
}
