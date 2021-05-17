<?php

namespace Database\Seeders;

use App\Models\DropDown;
use App\Models\Resource;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Resource::create([
            'name'=>'https://www.ncbi.nlm.nih.gov (National Center for Biotechnology Information)',
        ]);
        Resource::create([
            'name'=>'https://www.drugs.com',
        ]);
        Resource::create([
            'name'=>'Avoid Food- Drug Interactions:(A Guide from the National Consumers League and U.S. Food and Drug Administration)',
        ]);
        Resource::create([
            'name'=>'Handbook of Food- Drug Interactionsedited by Beverly J. McCabe Eric H. Frankel Jonathan J. Wolfe',
        ]);
    }
}
