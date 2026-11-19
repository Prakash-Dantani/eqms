<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'document_no',
        'title',
        'document_type_id',
        'category_id',
        'department_id',
        'owner',
        'version',
        'effective_date',
        'review_date',
        'expiry_date',
        'description',
        'attachment',
        'status',
        'document_id',
        'owner_id',
        'workflow_id',
        'current_step_id',
        'current_status',
        'current_version_id'
    ];

    protected $casts = [

        'created_at' => 'datetime',
        'updated_at' => 'datetime',

    ];

    public function documentType()
    {
        return $this->belongsTo(DocumentType::class, 'document_type_id');
    }

    public function category()
    {
        return $this->belongsTo(DocumentCategory::class, 'category_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function documentData()
    {
        return $this->belongsTo(DocumentMaster::class, 'document_id', 'document_id');
    }

    public function documentAttacment()
    {
        return $this->belongsTo(DocumentAttachment::class, 'document_version_id', 'document_id');
    }
    public function workflow()
    {
        return $this->belongsTo(Workflow::class);
    }

    public function currentVersion()
    {
        return $this->belongsTo(DocumentVersion::class, 'current_version_id');
    }

    public function versions()
    {
        return $this->hasMany(DocumentVersion::class);
    }

    public function revisionRequests()
    {
        return $this->hasMany(DocumentRevisionRequest::class);
    }

    public function auditLogs()
    {
        return $this->hasMany(DocumentAuditLog::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }


    // public function owner()
    // {
    //     return $this->belongsTo(User::class, 'owner_id');
    // }

}
