<?php

namespace App\Http\Requests\Api\Client;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'firstname' => ['required', 'string', 'min:2',],
            'lastname' => ['required', 'string', 'min:2',],
            'email' => ['required', 'email', 'unique:clients'],
            'phone' => ['required', 'numeric', 'unique:clients'],
            'ifu' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'public' => [ 'boolean'],
        ];
    }
}
