<?php

namespace App\Http\Requests\Milestone;

use Illuminate\Foundation\Http\FormRequest;

class MilestoneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            // 'created_by'    => [
            //     'required',
            //     'integer',
            //     'exists:users,id'
            // ],
            'name'    => [
                'required',
                'string',
                'min:4',
                'max:255',
            ],
        ];
    }
}
