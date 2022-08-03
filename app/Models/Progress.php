<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;

    protected $fillable = [
        'progress_id',
        'assignment_id',
        'student_id',
        'content',
        'percentage',
        'completed',
    ];
}
