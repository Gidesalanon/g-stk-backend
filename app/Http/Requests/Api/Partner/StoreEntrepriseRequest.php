<?php

namespace App\Http\Requests\Api\Entreprise;

use Illuminate\Foundation\Http\FormRequest;

class StoreEntrepriseRequest extends FormRequest
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
            'presentation' => ['nullable', 'string'],
            'public' => [ 'boolean'],
            'deleted' => [ 'boolean'],
        ];
    }
}
