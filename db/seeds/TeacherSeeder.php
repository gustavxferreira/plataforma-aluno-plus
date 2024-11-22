<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class TeacherSeeder extends AbstractSeed
{
    public function run(): void
    {
        $data =

            [
                'name'    => 'admin',
                'password' => password_hash("admin", PASSWORD_DEFAULT),
            ];
        $teacher = $this->table('teachers');
        $teacher->insert($data)->saveData();
    }
}
