<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'year',
        'section',
        'group_code',
        'status'
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function files() : HasMany {
        return $this->hasMany(StudentFile::class);
    }
}
