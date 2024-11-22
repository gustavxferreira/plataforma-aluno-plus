<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class StudentsSeeder extends AbstractSeed
{

    public function run(): void
    {
        $data = [
            [
                'name'      => 'João',
                'birthdate' => '2005-01-01',
                'email'     => 'joao@gmail.com',
            ],
            [
                'name'      => 'Maria',
                'birthdate' => '2006-03-15',
                'email'     => 'maria@gmail.com',
            ],
            [
                'name'      => 'Pedro',
                'birthdate' => '2004-08-21',
                'email'     => 'pedro@hotmail.com',
            ],
            [
                'name'      => 'Ana',
                'birthdate' => '2007-12-05',
                'email'     => 'ana@yahoo.com',
            ],
            [
                'name'      => 'Lucas',
                'birthdate' => '2003-11-11',
                'email'     => 'lucas@outlook.com',
            ],
        ];
        $students = $this->table('students');
        $students->insert($data)->saveData();
    }
}
