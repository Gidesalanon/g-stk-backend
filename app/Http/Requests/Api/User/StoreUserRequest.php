<?php

namespace App\Http\Requests\Api\User;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'username' => ['required', 'string', 'unique:users'],
            'firstname' => ['required', 'string', 'min:2', 'max:191'],
            'lastname' => ['required', 'string', 'min:2', 'max:191'],
            'email' => ['required', 'email', 'unique:users'],
            'parent_id' => ['required', 'string'],
            'role_id' => ['required', 'string'],
            'password' => [ 'min:8'],
            'public' => [ 'boolean'],
            'deleted' => [ 'boolean'],
        ];
    }
}
