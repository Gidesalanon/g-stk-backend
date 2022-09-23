<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Client;
use \App\Http\Requests\Api\Client\StoreClientRequest;
use \App\Http\Requests\Api\Client\UpdateClientRequest;
use App\Http\Resources\Client as ClientResource;
use App\Services\ClientService;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class ClientController extends Controller
{

    /**
     * @var ClientService
     */
    private $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // $this->authorize('view_any', Client::class);
        $load = ['users' ,'fichier'];
        $clients = Client::with($load)
                    ->orderByDesc('created_at')
                    ->filter(array_filter($request->all(),function($k){return $k!="page";},ARRAY_FILTER_USE_KEY))
                    ->paginate(9);
        return $clients;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClientRequest $request)
    {
       // $this->authorize('create', Client::class);
        $client = $this->clientService->create($request->validated());
        $client->load(['users', 'fichier']);
        return new ClientResource($client);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
      //  $this->authorize('view', Client::class);
        $load = ['users'];
            $client = Client::findOrFail($id)->load($load);
            return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        //$this->authorize('update', Client::class);

        $client = $this->clientService->update($client, $request->validated());

        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
      //  $this->authorize('delete', Client::class);

        if ($this->clientService->delete($client)) {
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
