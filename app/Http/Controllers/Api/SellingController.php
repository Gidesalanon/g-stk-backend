<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\SellingService;
use App\Models\User;
use App\Models\Selling;
use App\Models\SellingProduct;
use App\Models\CategorieProduct;
use \App\Http\Requests\Api\Selling\StoreSellingRequest;
use \App\Http\Requests\Api\Selling\UpdateSellingRequest;
use App\Http\Resources\Selling as SellingResource;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Support\Facades\Auth;

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
        $load = ['users', 'selling_products','clients'];
        $sellings = Selling::with($load)
                    ->orderByDesc('created_at')
                    ->filter(array_filter($request->all(),function($k){return $k!="page";},ARRAY_FILTER_USE_KEY))
                    ->paginate(15);
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

        $orderId = $this->sellingService->create([
            'description' => $request->description,
            'client_id' => $request->client_id,
            'public' => $request->public,
        ])->id;

        foreach ($request->products as $key => $value) {
            SellingProduct::create([
                'quantity' => $value['quantity']??'',
                'product_id' => $value['product_id']??'',
                'selling_id' => $orderId,
            ])->id;
        }

        return response()->json([
            'message' => 'Success selling'
        ], 200);
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
        $load = ['users', 'selling_products'];
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

    public function update(UpdateSellingRequest $request, $id)
    {
        $selling = Selling::findOrFail($id);
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
    public function destroy($id)
    {
        $selling = Selling::findOrFail($id);
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
