<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkflowStep extends Model
{
    use HasFactory;

    protected $fillable = [

        'workflow_id',

        'step_no',

        'step_name',

        'role_id',

        'can_edit',

        'approval_required',

        'signature_required',

        'send_email',

        'allow_reject',

        'allow_send_back',

        'is_final_step',

        'status'

    ];

    protected $casts = [

        'can_edit'            => 'boolean',

        'approval_required'   => 'boolean',

        'signature_required'  => 'boolean',

        'send_email'          => 'boolean',

        'allow_reject'        => 'boolean',

        'allow_send_back'     => 'boolean',

        'is_final_step'       => 'boolean',

        'status'              => 'boolean',

        'created_at'          => 'datetime',

        'updated_at'          => 'datetime',

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

    // public function role()
    // {
    //     return $this->belongsTo(Role::class);
    // }

    public function histories()
    {
        return $this->hasMany(WorkflowHistory::class, 'workflow_step_id');
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

    public function scopeEditable($query)
    {
        return $query->where('can_edit', 1);
    }

    public function scopeApprovalRequired($query)
    {
        return $query->where('approval_required', 1);
    }

    public function scopeSignatureRequired($query)
    {
        return $query->where('signature_required', 1);
    }

    /*
    |--------------------------------------------------------------------------
    | Helper Methods
    |--------------------------------------------------------------------------
    */

    public function isEditable(): bool
    {
        return (bool) $this->can_edit;
    }

    public function requiresApproval(): bool
    {
        return (bool) $this->approval_required;
    }

    public function requiresSignature(): bool
    {
        return (bool) $this->signature_required;
    }

    public function isFinalStep(): bool
    {
        return (bool) $this->is_final_step;
    }
}