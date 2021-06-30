<?php

namespace App\Models\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'civilid',
        'bd',
        'job',
        'photo',
    ];

}
