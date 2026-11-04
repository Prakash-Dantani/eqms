<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentVersion extends Model
{
    use HasFactory;

    protected $fillable = [

        'document_id',

        'version_no',
        'major_version',
        'minor_version',
        'revision_no',
        'revision_reason',

        'title',

        'document_type_id',
        'category_id',
        'department_id',
        'owner_id',

        'html_content',
        'attachment',

        'effective_date',
        'review_date',
        'expiry_date',

        'status',
        'is_current',

        'created_by',
        'updated_by',

        'approved_by',
        'approved_at'

    ];

    protected $casts = [

        'effective_date' => 'date',

        'review_date' => 'date',

        'expiry_date' => 'date',

        'approved_at' => 'datetime',

        'created_at' => 'datetime',

        'updated_at' => 'datetime',

        'is_current' => 'boolean',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function category()
    {
        return $this->belongsTo(DocumentCategory::class, 'category_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function attachments()
    {
        return $this->hasMany(DocumentAttachment::class);
    }

    public function auditLogs()
    {
        return $this->hasMany(DocumentAuditLog::class, 'document_version_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeCurrent($query)
    {
        return $query->where('is_current', 1);
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'Draft');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'Approved');
    }

    public function scopeEffective($query)
    {
        return $query->where('status', 'Effective');
    }
}
