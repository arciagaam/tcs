<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserRole extends Model
{
    use HasFactory;

    public function handledStudents() : BelongsToMany {
        return $this->belongsToMany(Student::class, 'teacher_students', 'teacher_id');
    }
}
