<?php

namespace App\Http\Requests\Api\Setting;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingRequest extends FormRequest
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
            'id' => ['nullable', 'string', 'min:2', 'max:255'],
            'organisation_name' => ['required', 'string', 'min:2', 'max:255'],
            'director_name' => ['required', 'string', 'min:2', 'max:255'],
            'director_position' => ['required', 'string', 'min:2', 'max:255'],
            'facebook_url' => [ 'nullable', 'string', 'min:2', 'max:255'],
            'twitter_url' => [ 'nullable', 'string', 'min:2', 'max:255'],
            'fichier' => ['nullable', 'file'],
            'welcome_content' => [ 'nullable', 'string', 'min:2'],
            'copyright' => [ 'nullable', 'string', 'min:2'],
            'copyright_author' => [ 'nullable', 'string', 'min:2', 'max:255'],
           
        ];
    }
}
