<?php

namespace App\Services;

use App\Models\Selling;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Services\LogoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class SellingService
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

        $sellingData = Arr::only($data, ['qty', 'description', 'public', 'user_id', 'product_id']);
        $sellingData['fichier_id'] = $fichier->id;
        $selling = Selling::create(array_merge($sellingData, [
            'user_id' => Auth::user()->id,
            'id' => (string) Str::uuid()
       ]));

        return $selling;
    }

    public function update(Selling $selling, array $data)
    {
        $sellingData = Arr::only($data, ['qty', 'description', 'public','user_id', 'product_id']);

        if (!empty($data['fichier'])) {
            $this->logoService->replace($data['fichier'], $selling->fichier);
        }

        $selling->update($sellingData);

        return $selling;
    }

    public function delete(Selling $selling)
    {
        return $selling->delete();
    }
}
