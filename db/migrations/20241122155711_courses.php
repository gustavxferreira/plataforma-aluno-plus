<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Courses extends AbstractMigration
{
  
    public function change(): void
    {
        $table = $this->table('courses');
        $table->addColumn('title', 'string', ['null' => false])
              ->addColumn('description', 'string')
              ->addColumn('duration', 'integer', ['null' => false])
              ->addColumn('date_archived', 'date')
              ->addTimestamps()
              ->create();
    }
}
