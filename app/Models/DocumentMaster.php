<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentMaster extends Model
{

    protected $table      = 'documents_master';
    protected $primarykey = 'document_id';
    protected $fillable   = [
        'document_no',
        'data',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'is_deleted',
        'deleted_by',
        'deleted_on',
    ];
}
