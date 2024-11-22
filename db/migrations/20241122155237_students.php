<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class Students extends AbstractMigration
{

    public function change(): void
    {
        $table = $this->table('students');
        $table->addColumn('name', 'string', ['null' => false])
            ->addColumn('birthdate', 'date', ['null' => false])
            ->addColumn('email', 'string', ['null' => false]) 
            ->addTimestamps()
            ->create();

        $this->table('students')
            ->addIndex(['email'], ['unique' => true])
            ->update();
    }
}
