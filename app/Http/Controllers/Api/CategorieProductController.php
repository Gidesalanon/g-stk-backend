<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\CategorieProduct;
use \App\Http\Requests\Api\CategorieProduct\StoreCategorieProductRequest;
use \App\Http\Requests\Api\CategorieProduct\UpdateCategorieProductRequest;
use App\Http\Resources\CategorieProduct as CategorieProductResource;
use App\Services\CategorieProductService;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Support\Arr;

class CategorieProductController extends Controller
{

    /**
     * @var CategorieProductService
     */
    private $categorieProductService;

    public function __construct(CategorieProductService $categorieProductService)
    {
        $this->categorieProductService = $categorieProductService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // $this->authorize('view_any', CategorieProduct::class);
        $load = ['users' ,'fichier'];
        $categorieProducts = CategorieProduct::with($load)
                    ->orderByDesc('created_at')
                    ->filter(array_filter($request->all(),function($k){return $k!="page";},ARRAY_FILTER_USE_KEY))
                    ->paginate(9);
        return $categorieProducts;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategorieProductRequest $request)
    {
       // $this->authorize('create', CategorieProduct::class);
        $categorieProduct = $this->categorieProductService->create($request->validated());
        $categorieProduct->load(['fichier']);
        return new CategorieProductResource($categorieProduct);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
      //  $this->authorize('view', CategorieProduct::class);
        $load = ['fichier'];
            $categorieProduct = CategorieProduct::findOrFail($id)->load($load);
            return new CategorieProductResource($categorieProduct);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategorieProductRequest $request, $categorieProduct)
    {
        $data = Arr::only($request->input(), ['name', 'description', 'public','user_id']);
        //$this->authorize('update', CategorieProduct::class);
        $categorieProduct = CategorieProduct::where('id', $categorieProduct)->update($data);
        // $categorieProduct = $this->categorieProductService->update($categorieProduct, $request->validated());

        // return new CategorieProductResource($categorieProduct);
        return true;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategorieProduct $categorieProduct)
    {
      //  $this->authorize('delete', CategorieProduct::class);

        if ($this->categorieProductService->delete($categorieProduct)) {
            return response()->json([
                'status' => 'success',
                'status_code' => Response::HTTP_NO_CONTENT,
                'message' => 'Deleted successful'
            ]);
        } else {
            return response()->json([
                'message' => 'Failed deleting resource'
            ], 400);
        }
    }
}
