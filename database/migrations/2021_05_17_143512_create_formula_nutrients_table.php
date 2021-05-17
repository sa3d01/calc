<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulaNutrientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formula_nutrients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tube_feeding_id')->nullable();
            $table->string('volume')->nullable();
            $table->string('k_cal')->nullable();
            $table->string('cho_g')->nullable();
            $table->string('protein_g')->nullable();
            $table->string('fat_g')->nullable();
            $table->string('na_mg')->nullable();
            $table->string('k_mg')->nullable();
            $table->string('p_mg')->nullable();
            $table->string('fiber_g')->nullable();
            $table->string('water_mL')->nullable();
            $table->string('mosm')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formula_nutrients');
    }
}
