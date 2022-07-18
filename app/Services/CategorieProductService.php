<?php

namespace App\Services;

use App\Models\CategorieProduct;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Services\CategorieProductFileUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class CategorieProductService
{
    /**
     * @var CategorieProductFileUploadService
     */
    private $categorieProductFileUploadService;

    /**
     *  constructor.
     * @param CategorieProductFileUploadService $categorieProductFileUploadService
     */
    public function __construct(CategorieProductFileUploadService $categorieProductFileUploadService)
    {
        $this->categorieProductFileUploadService = $categorieProductFileUploadService;
    }

    public function create(array $data)
    {
        $fichier = $this->categorieProductFileUploadService->save($data['fichier']);

        $categorieProductData = Arr::only($data, ['name', 'description', 'public']);
        $categorieProductData['fichier_id'] = $fichier->id;
        $categorieProduct = CategorieProduct::create(array_merge($categorieProductData, [
            'user_id' => Auth::user()->id,
            'id' => (string) Str::uuid()
       ]));

        return $categorieProduct;
    }

    public function update(CategorieProduct $categorieProduct, array $data)
    {
        $categorieProductData = Arr::only($data, ['name', 'description', 'public','user_id']);

        if (!empty($data['fichier'])) {
            $this->categorieProductFileUploadService->replace($data['fichier'], $categorieProduct->fichier);
        }

        $categorieProduct->update($categorieProductData);

        return $categorieProduct;
    }

    public function delete(CategorieProduct $categorieProduct)
    {
        return $categorieProduct->delete();
    }
}
