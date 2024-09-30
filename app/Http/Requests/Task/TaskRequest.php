<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'project_id'    => [
                'required',
                'integer',
                'exists:projects,id'
            ],
            'name'    => [
                'required',
                'string',
                'min:4',
                'max:255',
            ],
            // 'created_by'    => [
            //     'required',
            //     'integer',
            //     'exists:users,id'
            // ],
            'status_id'    => [
                'integer',
                'exists:task_statuses,id'
            ],
            'priority_id'    => [
                'integer',
                'exists:task_priorities,id'
            ],
        ];
    }
}
