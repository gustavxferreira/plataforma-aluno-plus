<?php

namespace App\Request;

use App\Models\Student;
use Illuminate\Http\Request;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Rules\AllOf;
use Respect\Validation\Rules\Key;
use Respect\Validation\Validator as v;

class StudentRequest
{
    public static function verifyEmail($email, $id = null)
    {
        return Student::where('email', $email)
            ->when($id, function ($query) use ($id) {
                return $query->where('id', '!=', $id);
            })
            ->exists();
    }

    public static function validate(Request $request)
    {
        $id = $request['id'] ?? null;

        $student = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'birthdate' => $request->input('birthdate'),
        ];

        $errors = [];
        $fields = [];
        try {
            $validate = new v;

            $validate->addRule(
                new Key(
                    'name',
                    new AllOf(
                        v::stringType(),
                        v::length(5, 200)->setTemplate('O campo precisa ter entre 5 a 200 caracteres'),
                        v::notEmpty()->setTemplate('Campo obrigatório!')
                    )
                )
            );

            $validate->addRule(
                new Key(
                    'email',
                    new AllOf(
                        v::stringType(),
                        v::length(5, 200)->setTemplate('O campo precisa ter entre 5 a 200 caracteres'),
                        v::email()->setTemplate('Insira um email válido'),
                        v::notEmpty()->setTemplate('Campo obrigatório!')
                    )
                )
            );

            if ($request['operation'] === 'create') {
                $validate->addRule(
                    new Key(
                        'email',
                        v::not(v::callback(function ($email) {
                            return StudentRequest::verifyEmail($email);
                        }))->setTemplate('Este email ja está cadastrado no sistema.')
                    )
                );
            } elseif ($request['operation'] === 'edit') {

                $validate->addRule(
                    new Key(
                        'email',
                        v::not(v::callback(function ($email) use ($id) {
                            return StudentRequest::verifyEmail($email, $id);
                        }))->setTemplate('Este email ja sendo utilizado.')
                    )
                );
            }

            $validate->addRule(
                new Key(
                    'birthdate',
                    new AllOf(
                        v::date()->setTemplate('Insira uma data válida - (DD/MM/YYYY)'),
                        v::notEmpty()->setTemplate('Campo obrigatório!'),
                        v::date()->between('1950-01-01', '2009-01-01')->setTemplate('Insira uma data entre 01/01/1950 a 01/01/2009'),
                    )
                )
            );

            $validate->assert($student);
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
