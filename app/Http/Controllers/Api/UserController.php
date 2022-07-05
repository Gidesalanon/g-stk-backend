<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\StoreUserRequest;
use App\Http\Requests\Api\User\UpdateUserRequest;
use App\Http\Requests\Api\User\UserRoleRequest;
use App\Http\Resources\User as UserResource;
use App\Models\User;
use App\Services\UserService;
use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Mail;
use App\Mail\GstkAccountMail;

use Illuminate\Http\Request;

/**
 * @OpenApi\PathItem()
 */
class UserController extends Controller
{

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Get(
     *      path="api/users",
     *      security={ {"bearer": {}} },
     *      operationId="getUsersList",
     *      tags={"users"},
     *      summary="Get list of users",
     *      description="Return users' list",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="array",
     *              @OA\Items(ref="#/components/schemas/UserResource")
     *          )
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
       // $this->authorize('view_any', User::class);
       $load = [ 'parents', 'allParents', 'children', 'allChildren', 'roles'];
       $users = User::with($load)
                ->filter($request->all())
              //  ->where('deleted',null)
              //  ->orwhere('deleted','0')
                ->orderByDesc('created_at')
                ->filter(array_filter($request->all(),function($k){return $k!="page";},ARRAY_FILTER_USE_KEY))
                ->paginate(request('per_page', 15));

        return $users;
    }
/**
     * @OA\Post(
     *      path="api/users",
     *      security={ {"bearer": {}} },
     *      operationId="storeUser",
     *      tags={"users"},
     *      summary="Store new user",
     *      description="Returns users data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreUserRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
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
    public function store(StoreUserRequest $request)
    {
       // $this->authorize('create', User::class);

        $user = $this->userService->create($request->validated());

        Mail::to($request->email)
              ->send(new GstkAccountMail($request->except('_token')));

        $user->load('roles');

        return new UserResource($user);
    }

        /**
     * @OA\Get(
     *      path="api/users/{id}",
     *      security={ {"bearer": {}} },
     *      operationId="getUserById",
     *      tags={"users"},
     *      summary="Get user information",
     *      description="Returns user data",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
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
     //   $this->authorize('view', User::class);
       $load = [ 'parents', 'allParents', 'children', 'allChildren', 'roles'];
       $user=User::findOrFail($id)->load($load);

        return new UserResource($user);
    }

    /**
     * @OA\Put(
     *      path="api/users/{id}",
     *      security={ {"bearer": {}} },
     *      operationId="updateUser",
     *      tags={"users"},
     *      summary="Update existing user",
     *      description="Returns updated user data",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateUserRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/User")
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
    /*  public function update(UpdateUserRequest $request, User $user)
    {
      //  $this->authorize('update', User::class);

        $user = $this->userService->update($user, $request->validated());

        return new UserResource($user);

    } */

    public function update(UpdateUserRequest $request, User $user)
    {
      //$this->authorize('update', User::class);
    //  $user->update($request->only(['username', 'email','password','firstname','lastname','public','deleted' ]));
        $user = $this->userService->update($user, $request->validated());
        Mail::to($request->email)
        ->send(new GstkAccountMail($request->except('_token')));

        return new UserResource($user);
    }
    /**
     * @OA\Delete(
     *      path="api/users/{id}",
     *      security={ {"bearer": {}} },
     *      operationId="deleteUser",
     *      tags={"users"},
     *      summary="Delete existing user",
     *      description="Deletes an user and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
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
    public function destroy(User $user)
    {
       // $this->authorize('delete', User::class);
        if ($this->userService->delete($user)) {
        //return response()->noContent();
        return response()->json([
            'message' => 'Resource deleted sucessfully.'
        ], 200);
        } else {
        return response()->json([
            'message' => 'Failed deleting resource'
        ], 400);
    }
    }

}
