<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Services\SettingFileUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class SettingService
{
    /**
     * @var SettingFileUploadService
     */
    private $settingFileUploadService;

    /**
     *  constructor.
     * @param SettingFileUploadService $settingFileUploadService
     */
    public function __construct(SettingFileUploadService $settingFileUploadService)
    {
        $this->settingFileUploadService = $settingFileUploadService;
    }


    public function create(array $data)
    {
        if(array_key_exists('fichier',$data)) $fichier = $this->settingFileUploadService->save($data['fichier']);

        $settingData = Arr::only($data, ['organisation_name', 'director_name', 'director_position','welcome_content','welcome_title', 'facebook_url', 'twitter_url', 'home_indicator_1', 'home_indicator_2','home_indicator_3','home_indicator_4','home_indicator_1_value','home_indicator_2_value','home_indicator_3_value','home_indicator_4_value', 'copyright', 'copyright_author']);
        if(array_key_exists('fichier',$data)) $settingData['fichier_id'] = $fichier->id;
        $setting = Setting::create(array_merge($settingData, [
            'id' => (string) Str::uuid()
       ]));

        return $setting;
    }

    public function update(Setting $setting, array $data)
    {
        $settingData = Arr::only($data, ['organisation_name', 'director_name', 'director_position','welcome_content','welcome_title', 'facebook_url', 'twitter_url', 'home_indicator_1', 'home_indicator_2','home_indicator_3','home_indicator_4','home_indicator_1_value','home_indicator_2_value','home_indicator_3_value','home_indicator_4_value', 'copyright', 'copyright_author']);

        if(array_key_exists('fichier',$data))  {
            $this->settingFileUploadService->replace($data['fichier'], $setting->fichier);
        }

        $setting->update($settingData);

        return $setting;
    }

    public function fupdate(array $data)
    {
        $setting = Setting::findOrFail($data['id'])->load('fichier');
        $settingData = Arr::only($data, ['organisation_name', 'director_name', 'director_position','welcome_content','welcome_title', 'facebook_url', 'twitter_url', 'home_indicator_1', 'home_indicator_2','home_indicator_3','home_indicator_4','home_indicator_1_value','home_indicator_2_value','home_indicator_3_value','home_indicator_4_value', 'copyright', 'copyright_author']);

        if(array_key_exists('fichier',$data))  {
            $fichier = $this->settingFileUploadService->replace($data['fichier'], $setting->fichier);
        }
        
        $setting->update($settingData);
        return $setting;
    }

    public function delete(Setting $setting)
    {
        return $setting->delete();
    }
}
