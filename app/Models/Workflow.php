<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    use HasFactory;

    protected $fillable = [

        'workflow_name',

        'workflow_code',

        'module',

        'description',

        'is_default',

        'status',

        'created_by',

        'updated_by'

    ];

    protected $casts = [

        'is_default' => 'boolean',

        'status' => 'boolean',

        'created_at' => 'datetime',

        'updated_at' => 'datetime',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function steps()
    {
        return $this->hasMany(WorkflowStep::class)
            ->orderBy('step_no');
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

    public function histories()
    {
        return $this->hasMany(WorkflowHistory::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeDefault($query)
    {
        return $query->where('is_default', 1);
    }

    public function scopeModule($query, $module)
    {
        return $query->where('module', $module);
    }
}
