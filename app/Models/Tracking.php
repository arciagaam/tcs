<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    protected $table = 'trackings';

    protected $fillable = [
        'student_submission_id',
        'group_code',
        'number',
        'name',
        'file_name',
        'file_path',
    ];
}
