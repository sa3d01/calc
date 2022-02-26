<?php

namespace App\Models;

use App\Traits\ModelBaseFunctions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropDown extends Model
{
    use HasFactory,ModelBaseFunctions;
    private $route='drop_down';
    private $images_link='media/images/drop_down/';
    protected $fillable = [
        'class',
        'status',
        'name',
        'image',
        'parent_id',
        'stress_factor_from',
        'stress_factor_to',
        'iso_code'
    ];
    public function parent():object
    {
        return $this->belongsTo(DropDown::class,'parent_id','id');
    }
    public function nutrient_factors():object
    {
        return $this->hasMany(NutrientFactor::class,'drug_id','id');
    }
    public function dietary_allowances():object
    {
        return $this->hasMany(DietaryAllowance::class,'age_category_id','id');
    }
}
