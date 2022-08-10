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
     * @OA\Get(
     *      path="api/categorieProducts",
     *      operationId="getCategorieProductsList",
     *      tags={"CategorieProducts"},
     *      summary="Get list of categorieProducts",
     *      description="Returns list of categorieProducts",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CategorieProductResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
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
     * @OA\Post(
     *      path="api/categorieProducts",
     *      operationId="storeCategorieProduct",
     *      tags={"CategorieProducts"},
     *      summary="Store new categorieProduct",
     *      description="Returns categorieProduct data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCategorieProductRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CategorieProduct")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
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
     * @OA\Get(
     *      path="api/categorieProducts/{id}",
     *      operationId="getCategorieProductById",
     *      tags={"CategorieProducts"},
     *      summary="Get categorieProduct information",
     *      description="Returns categorieProduct data",
     *      @OA\Parameter(
     *          name="id",
     *          description="CategorieProduct id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CategorieProduct")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
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
     * @OA\Put(
     *      path="api/categorieProducts/{id}",
     *      operationId="updateCategorieProduct",
     *      tags={"CategorieProducts"},
     *      summary="Update existing categorieProduct",
     *      description="Returns updated categorieProduct data",
     *      @OA\Parameter(
     *          name="id",
     *          description="CategorieProduct id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCategorieProductRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CategorieProduct")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategorieProductRequest $request, CategorieProduct $categorieProduct)
    {
        //$this->authorize('update', CategorieProduct::class);

        $categorieProduct = $this->categorieProductService->update($categorieProduct, $request->validated());

        return new CategorieProductResource($categorieProduct);
    }

    /**
     * @OA\Delete(
     *      path="api/categorieProducts/{id}",
     *      operationId="deleteCategorieProduct",
     *      tags={"CategorieProducts"},
     *      summary="Delete existing categorieProduct",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="CategorieProduct id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
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
