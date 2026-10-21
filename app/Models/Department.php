<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table = 'departments';

    protected $fillable = [
        'department_name',
        'department_code',
        'status',
    ];

    /**
     * Relationship with Sub Department
     */
    public function subDepartments()
    {
        return $this->hasMany(SubDepartment::class);
    }

    /**
     * Relationship with Users
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Relationship with Documents
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }

}
