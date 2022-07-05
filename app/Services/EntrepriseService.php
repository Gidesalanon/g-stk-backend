<?php

namespace App\Services;

use App\Models\Entreprise;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Services\LogoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class EntrepriseService
{
    /**
     * @var LogoService
     */
    private $logoService;

    /**
     *  constructor.
     * @param LogoService $logoService
     */
    public function __construct(LogoService $logoService)
    {
        $this->logoService = $logoService;
    }

    public function create(array $data)
    {
        $fichier = $this->logoService->save($data['fichier']);

        $entrepriseData = Arr::only($data, ['name', 'presentation', 'public']);
        $entrepriseData['fichier_id'] = $fichier->id;
        $entreprise = Entreprise::create(array_merge($entrepriseData, [
            'user_id' => Auth::user()->id,
            'id' => (string) Str::uuid()
       ]));

        return $entreprise;
    }

    public function update(Entreprise $entreprise, array $data)
    {
        $entrepriseData = Arr::only($data, ['name', 'presentation', 'public','user_id']);

        if (!empty($data['fichier'])) {
            $this->logoService->replace($data['fichier'], $entreprise->fichier);
        }

        $entreprise->update($entrepriseData);

        return $entreprise;
    }

    public function delete(Entreprise $entreprise)
    {
        return $entreprise->delete();
    }
}
