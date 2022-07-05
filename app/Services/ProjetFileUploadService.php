<?php

namespace App\Services;

use App\Models\Fichier;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjetFileUploadService
{
    public function create(array $data)
    {
        return $this->save($data['fichier']);
    }

    public function update(Fichier $fichier, array $data)
    {
        $fichier->update($data);

        return $fichier;
    }

    public function delete(Fichier $fichier)
    {
        return $fichier->delete();
    }

    public function save(UploadedFile $file)
    {
        $filename = Storage::disk('public')->putFile('projets', $file);

        // returns Intervention\Image\Image
       // $resizefile = Image::make(public_path($filename))->fit(1752,637);


        $fichier = Fichier::create([
            'filename' => $filename,
            'id' => (string) Str::uuid()
        ]);

        return $fichier;
    }

    public function replace(UploadedFile $file, Fichier $fichier)
    {
        $filename = Storage::disk('public')->putFile('projets', $file);

        $fichier->deleteOnDisk()->update([
            'filename' => $filename
        ]);

        return $fichier;
    }
}
