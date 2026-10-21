<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    protected $fillable = [
        'document_type_name',
        'document_type_code',
        'description',
        'status',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}
