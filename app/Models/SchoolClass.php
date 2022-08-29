<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    use HasFactory;
    protected $primaryKey = 'class_id';
    public $timestamps = false;

    protected $fillable = [
        'class_id',
        'class_name',
    ];


}
