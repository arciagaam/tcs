<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class StudentSubmission extends Model
{
    use HasFactory;

    protected $table = 'student_submissions';

    protected $fillable = [
        'student_id',
        'role_id',
        'group_code',
        'file_type',
        'file_name',
        'name',
        'path',
    ];

    function student(): BelongsTo {
        return $this->belongsTo(Student::class);
    }

    function check(): HasMany {
        return $this->hasMany(SubmissionCheck::class, 'student_submission_id');
    }
}
