<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\SellingService;
use App\Models\User;
use App\Models\Selling;
use \App\Http\Requests\Api\Selling\StoreSellingRequest;
use \App\Http\Requests\Api\Selling\UpdateSellingRequest;
use App\Http\Resources\Selling as SellingResource;
use App\Services\ProductService;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;

class SellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $sellingService;

    public function __construct(SellingService $sellingService)
    {
        $this->sellingService = $sellingService;
    }
    
    public function index(Request $request)
    {
        $load = ['users', 'products', 'fichier'];
        $sellings = Selling::with($load)
                    ->orderByDesc('created_at')
                    ->filter(array_filter($request->all(),function($k){return $k!="page";},ARRAY_FILTER_USE_KEY))
                    ->paginate(9);
        return $sellings;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreSellingRequest $request)
    {
       // $this->authorize('create', Product::class);
        $selling = $this->sellingService->create($request->validated());
        $selling->load(['users', 'products', 'fichier']);
        return new SellingResource($selling);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id, Request $request)
    {
      //  $this->authorize('view', Product::class);
        $load = ['users', 'products'];
            $selling = Selling::findOrFail($id)->load($load);
            return new SellingResource($selling);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateSellingRequest $request, Selling $selling)
    {
        //$this->authorize('update', Product::class);

        $selling = $this->sellingService->update($selling, $request->validated());

        return new SellingResource($selling);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Selling $selling)
    {
      //  $this->authorize('delete', Product::class);

        if ($this->sellingService->delete($selling)) {
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
