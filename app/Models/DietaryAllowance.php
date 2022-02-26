<?php

namespace App\Models;

use App\Traits\ModelBaseFunctions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DietaryAllowance extends Model
{
    use HasFactory,ModelBaseFunctions;
    protected $fillable = [
        'age_category_id',
        'Sodium',
        'Potassium',
        'Calcium',
        'Phosphorus',
        'Magnesium',
        'Iron',
        'Zinc',
        'Iodine',
        'Selenium',
        'Copper',
        'Chloride',
        'Chromium',
        'Fluoride',
        'Vitamin_A',
        'Vitamin_C',
        'Vitamin_D',
        'Vitamin_E',
        'Vitamin_K',
        'Vitamin_B12',
        'Thiamin',
        'Riboflavin',
        'Niacin',
        'Vitamin_B6',
        'Folate',
        'Biotin',
        'Pantothenic_Acid',
    ];
    public function ageCategory():object
    {
        return $this->belongsTo(DropDown::class,'age_category_id','id');
    }

}
