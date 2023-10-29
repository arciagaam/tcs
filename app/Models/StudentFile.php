<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentFile extends Model
{
    use HasFactory;

    protected $table = 'student_files';

    protected $fillable = [
        'student_id',
        'to_user_id',
        'to_role_id',
        'path',
        'status'
    ];

    public function student() : BelongsTo {
        return $this->belongsTo(Student::class);
    }

    public function toUserId() : BelongsTo {
        return $this->belongsTo(User::class, 'to_user_id');
    }

    public function toRoleId() : BelongsTo {
        return $this->belongsTo(Role::class, 'to_role_id');
    }
}
