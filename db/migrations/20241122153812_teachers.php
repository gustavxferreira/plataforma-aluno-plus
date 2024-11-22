<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Teachers extends AbstractMigration
{
    public function change(): void
    {
        $table = $this->table('teachers');
        $table->addColumn('name', 'string', ['null' => false])
        ->addColumn('password', 'string', ['null' => false])
        ->addTimestamps()
        ->create();
    }
}
