<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tracking extends Model
{
    use HasFactory;

    protected $table = 'trackings';

    protected $fillable = [
        'student_submission_id',
        'to_user_id',
        'group_code',
        'number',
        'name',
        'file_name',
        'file_path',
    ];
    public function studentSubmission() : BelongsTo {
        return $this->belongsTo(StudentSubmission::class);
    }
}
