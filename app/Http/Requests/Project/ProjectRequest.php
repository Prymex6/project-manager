<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name'          => [
                'required',
                'string',
                'min:4',
                'max:255',
            ],
            'company_id'    => [
                'required',
                'integer',
                'exists:companies,id'
            ],
            'status_id'     => [
                'integer',
                'exists:project_statuses,id'
            ],
        ];
    }
}
