<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_code',
        'user_role_id',
        'user_id',
        'name',
        'email',
        'title',
        'date',
        'description',
        'document_path',
        'status'
    ];

    public function group() : BelongsTo {
        return $this->belongsTo(Group::class);
    }
}
