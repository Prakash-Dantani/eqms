<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DocumentAttachment extends Model
{
    use HasFactory;

    protected $fillable = [

        'document_version_id',

        'file_name',

        'original_name',

        'file_path',

        'file_size',

        'mime_type',

        'uploaded_by'

    ];

    protected $casts = [

        'file_size' => 'integer',

        'created_at' => 'datetime',

        'updated_at' => 'datetime',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function documentVersion()
    {
        return $this->belongsTo(DocumentVersion::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    public function getFileSizeKbAttribute()
    {
        return round($this->file_size / 1024, 2);
    }

    public function getFileExtensionAttribute()
    {
        return pathinfo($this->original_name, PATHINFO_EXTENSION);
    }
}
