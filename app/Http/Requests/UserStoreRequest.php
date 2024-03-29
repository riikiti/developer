<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'email'=>'string|email|max:255',
            'username'=>'string|max:255|regex:/^[A-Za-z0-9]+$/i',
            'name'=>'string|nullable|min:2|max:255',
            'password' => 'string|min:6',
        ];
    }
}
