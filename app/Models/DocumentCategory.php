<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentCategory extends Model
{
    protected $fillable = [
        'category_name',
        'category_code',
        'description',
        'status',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class, 'category_id');
    }
}
