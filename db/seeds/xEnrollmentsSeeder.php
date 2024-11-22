<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class xEnrollmentsSeeder extends AbstractSeed
{
  
    public function run(): void
    {   $data = [
        [
            'student_id'      => 1,
            'course_id'       => 2,
            'enrollment_date' => '2024-01-15',
        ],
        [
            'student_id'      => 2,
            'course_id'       => 1,
            'enrollment_date' => '2024-02-10',
        ],
        [
            'student_id'      => 3,
            'course_id'       => 3,
            'enrollment_date' => '2024-03-20',
        ],
        [
            'student_id'      => 4,
            'course_id'       => 4,
            'enrollment_date' => '2024-04-25',
        ],
        [
            'student_id'      => 1,
            'course_id'       => 4,
            'enrollment_date' => '2024-05-30',
        ],
    ];
        $enrollments = $this->table('enrollments');
        $enrollments->insert($data)->saveData();
    }
}
