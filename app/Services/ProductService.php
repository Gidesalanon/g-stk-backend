<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Auth\AuthManager;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use App\Services\ProductFileUploadService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ProductService
{
    /**
     * @var ProductFileUploadService
     */
    private $productFileUploadService;

    /**
     *  constructor.
     * @param ProductFileUploadService $productFileUploadService
     */
    public function __construct(ProductFileUploadService $productFileUploadService)
    {
        $this->productFileUploadService = $productFileUploadService;
    }

    public function create(array $data)
    {
        if (!empty($data['fichier'])) $fichier = $this->productFileUploadService->save($data['fichier']);

        $productData = Arr::only($data, ['name', 'description', 'public', 'partner_price', 'client_price', 'point', 'expiration_date', 'expiration_mail_days', 'user_id']);
        if (!empty($data['fichier'])) $productData['fichier_id'] = $fichier->id;
        $product = Product::create(array_merge($productData, [
            'user_id' => Auth::user()->id,
            'id' => (string) Str::uuid()
       ]));

        return $product;
    }

    public function update(Product $product, array $data)
    {
        $productData = Arr::only($data, ['name', 'description', 'public', 'partner_price', 'client_price', 'point', 'expiration_date', 'expiration_mail_days', 'user_id']);

        if (!empty($data['fichier'])) {
            $this->productFileUploadService->replace($data['fichier'], $product->fichier);
        }

        $product->update($productData);

        return $product;
    }

    public function delete(Product $product)
    {
        return $product->delete();
    }
}
