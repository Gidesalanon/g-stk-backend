<?php

namespace App\Http\Requests\Api\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingRequest extends FormRequest
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
            'id' => ['required', 'string', 'min:32', 'max:200'],
            'organisation_name' => ['nullable', 'string', 'min:2', 'max:255'],
            'director_name' => ['nullable', 'string', 'min:2', 'max:255'],
            'director_position' => ['nullable', 'string', 'min:2', 'max:255'],
            'facebook_url' => [ 'nullable', 'string', 'min:2', 'max:255'],
            'twitter_url' => [ 'nullable', 'string', 'min:2', 'max:255'],
            'fichier' => ['nullable', 'file'],
            'welcome_content' => [ 'nullable', 'string', 'min:2'],
            'welcome_title' => [ 'nullable', 'string', 'min:2'],
            'home_indicator_1' => [ 'nullable', 'string', 'min:2', 'max:100'],
            'home_indicator_2' => [ 'nullable', 'string', 'min:2', 'max:100'],
            'home_indicator_3' => [ 'nullable', 'string', 'min:2', 'max:100'],
            'home_indicator_4' => [ 'nullable', 'string', 'min:2', 'max:100'],
            'home_indicator_1_value' => [ 'nullable', 'numeric'],
            'home_indicator_2_value' => [ 'nullable', 'numeric'],
            'home_indicator_3_value' => [ 'nullable', 'numeric'],
            'home_indicator_4_value' => [ 'nullable', 'numeric'],
            'copyright' => [ 'nullable', 'string'],
            'copyright_author' => [ 'nullable', 'string', 'min:2', 'max:255'],
        ];
    }
}
