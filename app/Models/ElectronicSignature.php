<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectronicSignature extends Model
{
    use HasFactory;

    protected $fillable = [

        'module',

        'record_id',

        'workflow_history_id',

        'user_id',

        'signature_password',

        'signed_at',

        'ip_address'

    ];

    protected $casts = [

        'signed_at'  => 'datetime',

        'created_at' => 'datetime',

        'updated_at' => 'datetime',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function workflowHistory()
    {
        return $this->belongsTo(WorkflowHistory::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Module Relationships
    |--------------------------------------------------------------------------
    */

    public function document()
    {
        return $this->belongsTo(Document::class, 'record_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeByModule($query, $module)
    {
        return $query->where('module', $module);
    }

    public function scopeByRecord($query, $recordId)
    {
        return $query->where('record_id', $recordId);
    }

    public function scopeLatestFirst($query)
    {
        return $query->latest('id');
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function isSigned(): bool
    {
        return !is_null($this->signed_at);
    }
}
