<?php

namespace App\Request;

use App\Enums\EnrollmentStatus;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Rules\AllOf;
use Respect\Validation\Rules\Key;
use Respect\Validation\Validator as v;

class EnrollmentRequest
{
    public static function verifyCourseEnrollment($studentId, $courseId, $enrollmentId = null)
    {
        return Enrollment::where('student_id', $studentId)
            ->where('course_id', $courseId)
            ->when($enrollmentId, function ($query) use ($enrollmentId) {
                return $query->where('id', '!=', $enrollmentId);
            })
            ->exists();
    }

    public static function validate(Request $request)
    {
        $id = $request['id'] ?? null;

        $statusInput = $request->input('status');
        $status = EnrollmentStatus::tryFrom($statusInput);

        $enrollment = [
            'student_id' => $request->input('student_id'),
            'course_id' => $request->input('course_id'),
            'enrollment_date' => $request->input('enrollment_date'),
            'status' => $status ?? $statusInput,
        ];

        $errors = [];
        $fields = [];
        try {
            $validate = new v;

            $validate->addRule(
                new Key(
                    'student_id',
                    new AllOf(
                        v::number()->setTemplate('O estudante inserido esta errado!'),
                        v::notEmpty()->setTemplate('Campo obrigatório!'),
                    )
                )
            );

            $validate->addRule(
                new Key(
                    'course_id',
                    new AllOf(
                        v::number()->setTemplate('O curso inserido esta errado!'),
                        v::notEmpty()->setTemplate('Campo obrigatório!'),
                    )
                )
            );

            $validate->addRule(
                new Key(
                    'status',
                    new AllOf(
                        v::in([EnrollmentStatus::ACTIVE, EnrollmentStatus::INACTIVE, EnrollmentStatus::SUSPENDED])->setTemplate('O status não pode ser diferente de ativo, inativo ou suspendida.'),
                        v::notEmpty()->setTemplate('O campo status é obrigatório!'),
                    )
                )
            );

            $validate->addRule(
                new Key(
                    'enrollment_date',
                    new AllOf(
                        v::date()->setTemplate('Insira uma data válida - (DD/MM/YYYY)'),
                        v::notEmpty()->setTemplate('Campo obrigatório!'),
                        v::date()->between('2020-01-01', '2030-01-01')->setTemplate('Insira uma data entre 01/01/2020 a 01/01/2030'),
                    )
                )
            );

            if ($request['operation'] === 'create') {
                $validate->addRule(
                    new Key(
                        'student_id',
                        v::not(v::callback(function ($studentId) use ($request) {

                            $courseId = $request['course_id'];
                            return EnrollmentRequest::verifyCourseEnrollment($studentId, $courseId);
                        }))->setTemplate('Este aluno já está matriculado neste curso.')
                    )
                );
            } elseif ($request['operation'] === 'edit') {
                $validate->addRule(
                    new Key(
                        'student_id',
                        v::not(v::callback(function ($studentId) use ($request, $id) {
         
                            $courseId = $request['course_id'];
                            return EnrollmentRequest::verifyCourseEnrollment($studentId, $courseId, $id);
                        }))->setTemplate('Este aluno já está matriculado neste curso.')
                    )
                );
            }



            $validate->assert($enrollment);
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
