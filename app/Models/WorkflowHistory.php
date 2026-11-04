<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowHistory extends Model
{
    use HasFactory;

    protected $fillable = [

        'workflow_id',

        'workflow_step_id',

        'module',

        'record_id',

        'action',

        'user_id',

        'remarks',

        'signature',

        'action_at',

        'ip_address',

        'browser_info'

    ];

    protected $casts = [

        'action_at'   => 'datetime',

        'created_at'  => 'datetime',

        'updated_at'  => 'datetime',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }

    public function workflowStep()
    {
        return $this->belongsTo(WorkflowStep::class, 'workflow_step_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Polymorphic Relation
    |--------------------------------------------------------------------------
    |
    | record_id + module will identify which module
    | Example:
    | module = DMS
    | record_id = documents.id
    |
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

    public function scopeLatestFirst($query)
    {
        return $query->latest('id');
    }

    public function scopeApproved($query)
    {
        return $query->where('action', 'Approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('action', 'Rejected');
    }

    public function scopeSendBack($query)
    {
        return $query->where('action', 'Send Back');
    }

    public function scopeByWorkflow($query, $workflowId)
    {
        return $query->where('workflow_id', $workflowId);
    }

    public function scopeByRecord($query, $recordId)
    {
        return $query->where('record_id', $recordId);
    }

    public function scopeByModule($query, $module)
    {
        return $query->where('module', $module);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function isApproved(): bool
    {
        return $this->action === 'Approved';
    }

    public function isRejected(): bool
    {
        return $this->action === 'Rejected';
    }

    public function isSendBack(): bool
    {
        return $this->action === 'Send Back';
    }
}
