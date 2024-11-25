<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class CoursesSeeder extends AbstractSeed
{

    public function run(): void
    {
        $data =
            [
                [
                    'title'         => 'Biologia',
                    'description'   => 'Estudo da vida e dos seres vivos, incluindo anatomia, ecologia e evolução.',
                    'duration'      => 12,
                    'date_archived' => null,
                ],
                [
                    'title'         => 'Matemática',
                    'description'   => 'Curso focado em álgebra, geometria e cálculo diferencial.',
                    'duration'      => 12,
                    'date_archived' => null,
                ],
                [
                    'title'         => 'História',
                    'description'   => 'Exploração dos principais eventos históricos e sua influência no mundo atual.',
                    'duration'      => 12,
                    'date_archived' => null,
                ],
                [
                    'title'         => 'Programação em PHP',
                    'description'   => 'Curso básico de desenvolvimento web utilizando PHP e bancos de dados.',
                    'duration'      => 6,
                    'date_archived' => '2024-11-01',
                ],

            ];
        $courses = $this->table('courses');
        $courses->insert($data)->saveData();
    }
}
