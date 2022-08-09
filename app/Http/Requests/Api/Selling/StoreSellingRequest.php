<?php

namespace App\Http\Requests\Api\Selling;

use Illuminate\Foundation\Http\FormRequest;

class StoreSellingRequest extends FormRequest
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
            'quantity' => ['nullable', 'integer'],
            'description' => ['nullable', 'string'],
            'product_id' => ['required'],
            'user_id' => ['required'],
            'fichier' => ['required', 'file'],
            'public' => [ 'boolean'],
        ];
    }
}