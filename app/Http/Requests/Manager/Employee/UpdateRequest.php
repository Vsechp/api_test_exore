<?php

namespace App\Http\Requests\Manager\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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


    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $this->employee->id,
            'role' => 'required|in:manager,employee',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'This field needs to be filled',
            'name.string' => 'This name needs to be a string',
            'email.required' => 'This field needs to be filled',
            'email.string' => 'This name needs to be a string',
            'email.email' => 'The name must match the format mail@any.domain',
            'email.unique' => 'User with this email already exists',
        ];
    }
}
