<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['document_no', 'title', 'document_type_id', 'category_id', 'department_id', 'owner', 'version', 'effective_date', 'review_date', 'expiry_date', 'description', 'attachment', 'status'];

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
    // public function owner()
    // {
    //     return $this->belongsTo(User::class, 'owner_id');
    // }

}
