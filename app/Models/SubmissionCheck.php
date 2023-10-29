<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionCheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_submission_id',
        'file_name',
        'file_path',
        'remarks',
    ];
}
