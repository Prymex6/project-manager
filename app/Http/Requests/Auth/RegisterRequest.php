<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'login'      => ['required', 'string', 'max:255', 'unique:' . User::class],
            'email'      => ['required', 'string', 'email', 'lowercase', 'max:255', 'unique:' . User::class],
            'password'   => ['required', 'string', 'min:8', 'confirmed', Rules\Password::defaults()]
        ];
    }

    public function messages()
    {
        return [
            'login.unique'          => 'Ten login jest już zajęty.',
            'email.unique'          => 'Ten adres e-mail jest już zarejestrowany.',
            'password.min'          => 'Hasło musi zawierać co najmniej 8 znaków.',
            'password.confirmed'    => 'Hasła muszą się zgadzać.',
        ];
    }
}
