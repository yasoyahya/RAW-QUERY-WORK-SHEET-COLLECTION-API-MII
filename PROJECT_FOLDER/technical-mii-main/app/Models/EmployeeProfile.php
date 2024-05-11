<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    use HasFactory;
    protected $table = 'employee_profile';

    protected $fillable = [
        'employee_id',
        'place_of_birth',
        'date_of_birth',
        'gender',
        'is_married',
        'prof_pict',
        'created_by',
        'updated_by'
    ];
}
