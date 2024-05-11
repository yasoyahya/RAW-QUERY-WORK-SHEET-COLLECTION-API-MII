<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeFamily extends Model
{
    use HasFactory;
    protected $table = 'employee_family';

    protected $fillable = [
        'employee_id',
        'name',
        'identifier',
        'job',
        'place_of_birth',
        'date_of_birth',
        'religion',
        'is_life',
        'is_divorced',
        'relation_status',
        'created_by',
        'updated_by',
    ];
}
