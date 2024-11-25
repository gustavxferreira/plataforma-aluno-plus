<?php

namespace App\Request;

use Illuminate\Http\Request;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Rules\AllOf;
use Respect\Validation\Rules\Key;
use Respect\Validation\Validator as v;

class CourseRequest
{
    public static function validate(Request $request)
    {
        $course = [
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'duration' => $request->input('duration'),
            'date_archived' => $request->input('date_archived', null),
        ];
        
        $errors = [];
        $fields = [];
        try {
            $validate = new v;

            $validate->addRule(
                new Key(
                    'title',
                    new AllOf(
                        v::stringType(),
                        v::length(5, 200)->setTemplate('O campo precisa ter entre 5 a 200 caracteres'),
                        v::notEmpty()->setTemplate('Campo obrigatório!')
                    )
                )
            );

            $validate->addRule(
                new Key(
                    'duration',
                    new AllOf(
                        v::number()->setTemplate('O valor não pode ser diferente de um número!'),
                        v::notEmpty()->setTemplate('Campo obrigatório!'),
                    )
                )
            );

            $validate->addRule(
                new Key(
                    'date_archived',
                    new AllOf(
                        v::nullable(v::date()->between('2023-01-01', '2030-01-01')->setTemplate('Insira uma data válida - (DD/MM/YYYY)')),
                    )
                )
            );

            $validate->assert($course);
        } catch (NestedValidationException $e) {

            $errors = $e->getMessages();
            $fields = array_keys($errors);

            return json_response([
                'errors' => $errors,
                'fields' => $fields
            ], 400);
        }
    }
}
