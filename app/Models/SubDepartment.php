<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubDepartment extends Model
{
    protected $table = 'sub_departments';

    protected $fillable = [
        'department_id',
        'sub_department_name',
        'sub_department_code',
        'status',
    ];

    /**
     * Parent Department
     */
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Users
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
