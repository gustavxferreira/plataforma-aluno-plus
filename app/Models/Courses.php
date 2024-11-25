<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;
    protected $table = 'courses';

    protected $fillable = [
        'title',
        'description',
        'duration',
        'date_archived',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments', 'course_id', 'student_id')
            ->withPivot(['enrollment_code', 'enrollment_date', 'status'])
            ->withTimestamps();
    }
}
