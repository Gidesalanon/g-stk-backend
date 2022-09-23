<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\CommandService;
use App\Models\User;
use App\Models\CommandProduct;
use App\Models\Command;
use App\Models\CategorieProduct;
use \App\Http\Requests\Api\Command\StoreCommandRequest;
use \App\Http\Requests\Api\Command\UpdateCommandRequest;
use App\Http\Resources\Command as CommandResource;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Support\Facades\Auth;

class CommandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    private $commandService;

    public function __construct(CommandService $commandService)
    {
        $this->commandService = $commandService;
    }
    
    public function index(Request $request)
    {
        $load = ['users', 'fichier', 'command_products'];
        $commands = Command::with($load)
                    ->orderByDesc('created_at')
                    ->filter(array_filter($request->all(),function($k){return $k!="page";},ARRAY_FILTER_USE_KEY))
                    ->paginate(15);
        return $commands;
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

    public function store(StoreCommandRequest $request)
    {
        // dd($request->all());
       // $this->authorize('create', Product::class);

        $orderId = $this->commandService->create([
            'description' => $request->description,
        ])->id;

        // dd($orderId);
        foreach ($request->products as $key => $value) {
            CommandProduct::create([
                'expiration_date' => $value['expiration_date']??'',
                'quantity' => $value['quantity']??'',
                'product_id' => $value['product_id']??'',
                'command_id' => $orderId,
            ])->id;
        }

        return response()->json([
            'message' => 'Success command'
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
        $load = ['users', 'fichier'];
            $command = Command::findOrFail($id)->load($load);
            return new CommandResource($command);
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

    public function update(UpdateCommandRequest $request, $id)
    {
        $command = Command::findOrFail($id);
        //$this->authorize('update', Product::class);

        $command = $this->commandService->update($command, $request->validated());

        return new CommandResource($command);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $command = Command::findOrFail($id);
        //  $this->authorize('delete', Product::class);

        if ($this->commandService->delete($command)) {
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
