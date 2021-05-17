<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NutrientFactor extends Model
{
    use HasFactory;
    protected $fillable = [
        'drug_id',
        'result',
    ];
}
