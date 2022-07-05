<?php

namespace App\Services;

use App\Models\Projet;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Services\ProjetFileUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ProjetService
{
    /**
     * @var ProjetFileUploadService
     */
    private $projetFileUploadService;

    /**
     *  constructor.
     * @param ProjetFileUploadService $projetFileUploadService
     */
    public function __construct(ProjetFileUploadService $projetFileUploadService)
    {
        $this->projetFileUploadService = $projetFileUploadService;
    }


    public function create(array $data)
    {
        if(array_key_exists('fichier',$data)) $fichier = $this->projetFileUploadService->save($data['fichier']);

        $projetData = Arr::only($data, ['nom','departement','pole_developpement','taux_execution', 'description','montant', 'debut', 'fin', 'status', 'financeur','public','module_id']);
        if(array_key_exists('fichier',$data)) $projetData['fichier_id'] = $fichier->id;
        $projet = Projet::create(array_merge($projetData, [
            'user_id' => Auth::user()->id,
            'id' => (string) Str::uuid()
       ]));

        return $projet;
    }

    public function update(Projet $projet, array $data)
    {
        $projetData = Arr::only($data, ['nom','departement','pole_developpement', 'taux_execution', 'description','montant', 'debut', 'fin', 'status', 'financeur', 'public','module_id', 'user_id']);

        if(array_key_exists('fichier',$data))  {
            $this->projetFileUploadService->replace($data['fichier'], $projet->fichier);
        }

        $projet->update($projetData);

        return $projet;
    }

    public function delete(Projet $projet)
    {
        return $projet->delete();
    }
}
