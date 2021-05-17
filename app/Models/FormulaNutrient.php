<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormulaNutrient extends Model
{
    use HasFactory;
    protected $fillable = [
        'tube_feeding_id',
        'volume',
        'k_cal',
        'cho_g',
        'protein_g',
        'fat_g',
        'na_mg',
        'k_mg',
        'p_mg',
        'fiber_g',
        'water_mL',
        'mosm',
    ];
}
