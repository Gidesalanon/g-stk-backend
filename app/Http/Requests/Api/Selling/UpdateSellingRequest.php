<?php

namespace App\Http\Requests\Api\Selling;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSellingRequest extends FormRequest
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
            'description' => ['nullable', 'string'],
            'client_id' => ['nullable', 'string'],
            'products' => ['required'],
            'public' => [ 'nullable', 'boolean'],
        ];
    }
}
