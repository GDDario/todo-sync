<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UpdateTodoRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => [
                'required'
            ],
            'is_urgent' => [
                'required',
                'bool'
            ],
            'todo_list_uuid' => [
                'required',
                'uuid'
            ],
            'todo_group_uuid' => [
                'uuid',
                'nullable'
            ],
            'due_date' => [
                'date',
                'nullable'
            ],
            'schedule_options' => [
                'nullable'
            ],
            'tags' => [
                'array'
            ]
        ];
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator): void
    {
        $response = new JsonResponse(['errors' => $validator->errors()], 422);

        throw new HttpResponseException($response);
    }
}
