<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class AddStatusToEnrollments extends AbstractMigration
{

    public function change(): void
    {
        $this->execute("
        ALTER TABLE enrollments 
        ADD COLUMN status ENUM('active', 'inactive', 'suspended') NOT NULL DEFAULT 'active' AFTER enrollment_date
    ");
    }
}
