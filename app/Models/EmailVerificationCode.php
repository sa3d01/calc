<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerificationCode extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'email',
        'code',
        'expires_at',
        'verified_at',
    ];
}
