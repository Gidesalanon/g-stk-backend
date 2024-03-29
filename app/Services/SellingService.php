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
    public function create(array $data)
    {
        $sellingData = Arr::only($data, [ 'description', 'client_id', 'public' ]);
        $selling = Selling::create(array_merge($sellingData, [
            'user_id' => Auth::user()->id,
            'id' => (string) Str::uuid()
       ]));

        return $selling;
    }

    public function update(Selling $selling, array $data)
    {
        $sellingData = Arr::only($data, [ 'description', 'client_id', 'public' ]);

        $selling->update($sellingData);

        return $selling;
    }

    public function delete(Selling $selling)
    {
        return $selling->delete();
    }
}
