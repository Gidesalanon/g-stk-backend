<?php

namespace App\Http\Requests\Api\CategorieProduct;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategorieProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2',],
            'fichier' => ['required', 'file'],
            'description' => ['nullable', 'string'],
            'public' => [ 'boolean'],
        ];
    }
}
