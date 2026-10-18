<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [

        'document_no',

        'title',

        'document_type',

        'category',

        'department',

        'owner',

        'version',

        'effective_date',

        'review_date',

        'expiry_date',

        'description',

        'attachment',

        'status',
    ];
}
