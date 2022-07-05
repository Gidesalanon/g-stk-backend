<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Entreprise;
use \App\Http\Requests\Api\Entreprise\StoreEntrepriseRequest;
use \App\Http\Requests\Api\Entreprise\UpdateEntrepriseRequest;
use App\Http\Resources\Entreprise as EntrepriseResource;
use App\Services\EntrepriseService;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class EntrepriseController extends Controller
{

    /**
     * @var EntrepriseService
     */
    private $entrepriseService;

    public function __construct(EntrepriseService $entrepriseService)
    {
        $this->entrepriseService = $entrepriseService;
    }

    /**
     * @OA\Get(
     *      path="api/entreprises",
     *      operationId="getEntreprisesList",
     *      tags={"Entreprises"},
     *      summary="Get list of entreprises",
     *      description="Returns list of entreprises",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/EntrepriseResource")
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
       // $this->authorize('view_any', Entreprise::class);
        $load = ['users' ,'fichier'];
        $entreprises = Entreprise::with($load)
                    ->orderByDesc('created_at')
                    ->filter(array_filter($request->all(),function($k){return $k!="page";},ARRAY_FILTER_USE_KEY))
                    ->paginate(9);
        return $entreprises;

    }


    /**
     * @OA\Post(
     *      path="api/entreprises",
     *      operationId="storeEntreprise",
     *      tags={"Entreprises"},
     *      summary="Store new entreprise",
     *      description="Returns entreprise data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreEntrepriseRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Entreprise")
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
    public function store(StoreEntrepriseRequest $request)
    {
       // $this->authorize('create', Entreprise::class);
        $entreprise = $this->entrepriseService->create($request->validated());
        $entreprise->load(['users', 'fichier']);
        return new EntrepriseResource($entreprise);
    }

    /**
     * @OA\Get(
     *      path="api/entreprises/{id}",
     *      operationId="getEntrepriseById",
     *      tags={"Entreprises"},
     *      summary="Get entreprise information",
     *      description="Returns entreprise data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Entreprise id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Entreprise")
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
      //  $this->authorize('view', Entreprise::class);
        $load = ['users'];
            $entreprise = Entreprise::findOrFail($id)->load($load);
            return new EntrepriseResource($entreprise);
    }


    /**
     * @OA\Put(
     *      path="api/entreprises/{id}",
     *      operationId="updateEntreprise",
     *      tags={"Entreprises"},
     *      summary="Update existing entreprise",
     *      description="Returns updated entreprise data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Entreprise id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateEntrepriseRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/Entreprise")
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
    public function update(UpdateEntrepriseRequest $request, Entreprise $entreprise)
    {
        //$this->authorize('update', Entreprise::class);

        $entreprise = $this->entrepriseService->update($entreprise, $request->validated());

        return new EntrepriseResource($entreprise);
    }

    /**
     * @OA\Delete(
     *      path="api/entreprises/{id}",
     *      operationId="deleteEntreprise",
     *      tags={"Entreprises"},
     *      summary="Delete existing entreprise",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Entreprise id",
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
    public function destroy(Entreprise $entreprise)
    {
      //  $this->authorize('delete', Entreprise::class);

        if ($this->entrepriseService->delete($entreprise)) {
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
