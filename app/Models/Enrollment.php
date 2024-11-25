<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    use HasFactory;
    protected $table = 'enrollments';

    protected $fillable = [
        'student_id',
        'course_id',
        'enrollment_code',
        'enrollment_date',
        'status',
    ];

    public function course()
    {
        return $this->belongsTo(Courses::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
