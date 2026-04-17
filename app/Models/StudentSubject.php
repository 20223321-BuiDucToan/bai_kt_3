<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class StudentSubject extends Pivot
{
    protected $table = 'student_subject';

    public $incrementing = false;

    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'subject_id',
        'score',
        'registered_at',
    ];

    protected $casts = [
        'registered_at' => 'datetime',
        'score' => 'decimal:2',
    ];
}
