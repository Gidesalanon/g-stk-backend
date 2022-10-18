<?php

namespace App\Http\Requests\Api\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'fichier' => ['nullable', 'file'],
            'description' => ['nullable', 'string'],
            'expiration_date' => ['nullable', 'date'],
            'quantity' => ['nullable', 'numeric'],
            'point' => ['nullable', 'numeric'],
            'client_price' => ['nullable', 'numeric'],
            'partner_price' => ['nullable', 'numeric'],
            'expiration_mail_days' => ['nullable', 'numeric'],
            'public' => [ 'boolean'],
        ];
    }
}
