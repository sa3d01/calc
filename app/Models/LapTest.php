<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LapTest extends Model
{
    use HasFactory;
    protected $fillable = [
        'factor_id',
        'result',
        'up',
        'down'
    ];
    public function factor()
    {
        return $this->belongsTo(DropDown::class,'factor_id','id');
    }
}
