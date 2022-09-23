<?php

namespace App\Services;

use App\Models\Command;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Services\LogoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class CommandService
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
        if (!empty($data['fichier'])) $fichier = $this->logoService->save($data['fichier']);

        $commandData = Arr::only($data, [ 'description', 'public' ]);
        if (!empty($data['fichier'])) $commandData['fichier_id'] = $fichier->id;
        $command = Command::create(array_merge($commandData, [
            'user_id' => Auth::user()->id,
            'id' => (string) Str::uuid()
       ]));

        return $command;
    }

    public function update(Command $command, array $data)
    {
        $commandData = Arr::only($data, [ 'description', 'public' ]);

        if (!empty($data['fichier'])) {
            $this->logoService->replace($data['fichier'], $selling->fichier);
        }

        $command->update($commandData); 

        return $command;
    }

    public function delete(Command $command)
    {
        return $command->delete();
    }
}
