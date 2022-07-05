<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Http\Requests\Api\Fichier\StoreFichierRequest;
use App\Http\Requests\Api\Fichier\UpdateFichierRequest;
use App\Services\FichierService;
use App\Models\Fichier;
use App\Http\Resources\Fichier as FichierResource;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
/**
 * @OpenApi\PathItem()
 */
class FichiersController extends Controller
{
    /**
     * @var FichierService
     */
    private $fichierService;

    public function __construct(FichierService $fichierService)
    {
        $this->fichierService = $fichierService;
    }

    /**
     * @OA\Get(
     *     path="/api/fichiers",
     *     description="Return fichiers' list",
     *     tags={"Fichiers"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/FichierResource")
     *       ),
     *     security={ {"bearer": {}} }
     * )
     */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
     //   $this->authorize('view_any', Fichier::class);

        $fichiers = Fichier::paginate(15)
            ;

        return $fichiers ;
    }

    /**
     * @OA\Post(
     *     path="/api/fichiers",
     *     description="Create fichier",
     *     tags={"Fichiers"},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreFichierRequest")
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="",
     *          @OA\JsonContent(ref="#/components/schemas/Fichier")
     *     ),
     *     security={ {"bearer": {}} }
     * )
     */
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFichierRequest $request)
    {
       // $this->authorize('create', Fichier::class);
        $fichier = $this->fichierService->create($request->validated());
        return response()->json([
            'success' => 1,
            'status_code' => Response::HTTP_CREATED,
            'file' => [
                'url' => 'http://g-stk-backend.test/public/storage/'.$fichier["filename"]
            ]
            
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/fichiers/{id}",
     *     description="Show fichier",
     *     tags={"Fichiers"},
     *     @OA\Response(
     *          response=200,
     *          description="",
     *          @OA\JsonContent(ref="#/components/schemas/Fichier")
     *     ),
     *     security={ {"bearer": {}} }
     * )
     */
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
      //  $this->authorize('view', Fichier::class);

        $fichier = Fichier::include($request->input('include', []))->findOrFail($id);

        return new FichierResource($fichier);
    }

    /**
     * @OA\Put(
     *     path="/api/fichiers/{id}",
     *     description="Update fichier",
     *     tags={"Fichiers"},
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateFichierRequest")
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="",
     *          @OA\JsonContent(ref="#/components/schemas/Fichier")
     *     ),
     *     security={ {"bearer": {}} }
     * )
     */
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFichierRequest $request, Fichier $fichier)
    {
       // $this->authorize('update', Fichier::class);

        $fichier = $this->fichierService->update($fichier, $request->validated());

        return new FichierResource($fichier);
    }

    /**
     * @OA\Delete(
     *     path="/api/fichiers/{id}",
     *     description="Delete fichier",
     *     tags={"Fichiers"},
     *     @OA\Response(response=200, description=""),
     *     security={ {"bearer": {}} }
     * )
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fichier $fichier)
    {
      //  $this->authorize('delete', Fichier::class);

        if ($this->fichierService->delete($fichier)) {
            return response()->noContent();
        } else {
            return response()->json([
                'message' => 'Failed deleting resource'
            ], 400);
        }
    }
}
