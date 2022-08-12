<?php

namespace App\Http\Requests\Api\CategorieProduct;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategorieProductRequest extends FormRequest
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
            'name' => ['nullable', 'string', 'min:2', 'max:255'],
            'description' => ['nullable', 'string'],
            'fichier' => ['nullable', 'file'],
            'public' => [ 'boolean'],
            'deleted' => [ 'boolean'],
        ];
    }
}
