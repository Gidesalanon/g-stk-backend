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
            'quantity' => ['required', 'integer'],
            'montant' => ['required', 'integer'],
            'type_price' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'product_id' => ['required'],
            'user_id' => ['required'],
            'fichier' => ['required', 'file'],
            'public' => [ 'boolean'],
        ];
    }
}
