<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Enrollments extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table('enrollments');
        $table->addColumn('student_id', 'integer', ['signed' => false, 'null' => false])
            ->addColumn('course_id', 'integer', ['signed' => false, 'null' => false])
            ->addColumn('enrollment_code', 'string', ['null' => false])
            ->addColumn('enrollment_date', 'date', ['null' => false])
            ->addTimestamps()
            ->addForeignKey('course_id', 'courses', 'id', ['delete' => 'NO_ACTION', 'update' => 'NO_ACTION'])
            ->addForeignKey('student_id', 'students', 'id', ['delete' => 'CASCADE', 'update' => 'NO_ACTION'])
            ->create();
    }
}
