<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';

    protected $fillable = ['nik', 'name', 'is_active', 'start_date', 'end_date', 'created_by', 'updated_by'];

    public function educations(): HasMany
    {
        return $this->hasMany(Education::class, 'employee_id', 'id');
    }
    public function profiles(): HasMany
    {
        return $this->hasMany(EmployeeProfile::class, 'employee_id', 'id');
    }
    public function familys(): HasMany
    {
        return $this->hasMany(EmployeeFamily::class, 'employee_id', 'id');
    }
}
