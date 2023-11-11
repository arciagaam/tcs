<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_code',
        'user_id',
        'user_role_id',
        'consultation_name',
        'name',
        'email',
        'document_path',
        'remarks',
        'status',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }

}
