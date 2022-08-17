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
