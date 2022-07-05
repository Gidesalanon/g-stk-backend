<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => ['required', 'string', 'min:2', 'max:191', Rule::unique('users')->ignore($this->user->id)],
            'email' => ['required', 'email',Rule::unique('users')->ignore($this->user->id)],
            'parent_id' => ['required', 'string'],
            'role_id' => ['nullable', 'string'],
            'password' => ['nullable', 'min:8'],
            'public' => [ 'boolean'],
            'deleted' => [ 'boolean'],
        ];
    }
}
