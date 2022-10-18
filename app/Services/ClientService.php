<?php

namespace App\Services;

use App\Models\Client;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Services\LogoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ClientService
{
    
    public function create(array $data)
    {

        $clientData = Arr::only($data, ['email', 'firstname', 'lastname', 'phone', 'address', 'ifu', 'description', 'user_id', 'public']);
        if (!empty($data['fichier'])) $clientData['fichier_id'] = $fichier->id;
        $client = Client::create(array_merge($clientData, [
            'user_id' => Auth::user()->id,
            'id' => (string) Str::uuid()
       ]));

        return $client;
    }

    public function update(Client $client, array $data)
    {
        $clientData = Arr::only($data, ['email', 'firstname', 'lastname', 'phone', 'address', 'ifu', 'description', 'user_id', 'public']);

        $client->update($clientData);

        return $client;
    }

    public function delete(Client $client)
    {
        return $client->delete();
    }
}
