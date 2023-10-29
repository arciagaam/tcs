<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherStudent extends Model
{
    use HasFactory;

    protected $table = 'teacher_students';

    protected $fillable = [
        'teacher_id',   
        'student_id',    
    ];

    public function student() : BelongsTo {
        return $this->belongsTo(Student::class);
    }

    public function teacher() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
