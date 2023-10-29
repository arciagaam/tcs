<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'code'
    ];

    public function users() : HasMany {
        return $this->hasMany(User::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
