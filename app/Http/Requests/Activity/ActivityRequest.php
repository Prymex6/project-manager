<?php

namespace App\Http\Requests\Activity;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
            'task_id'    => [
                'nullable',
                'integer',
                'exists:tasks,id'
            ],
            'content'       => [
                'required',
                'min:2'
            ],
        ];
    }
}
