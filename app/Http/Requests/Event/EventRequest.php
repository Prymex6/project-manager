<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
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
            'user_id'   => [
                'required',
                'integer',
                'exists:users,id'
            ],
            'title'     => [
                'required',
                'string',
                'min:4',
                'max:255',
            ],
            'status_id' => [
                'integer',
                'exists:event_statuses,id'
            ],
        ];
    }
}
