<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use GuzzleHttp\Client;
use Laravel\Passport\Passport;
use Carbon\Carbon;
use App\Http\Resources\User as UserResource;
use App\Services\UserService;
use Laravel\Passport\Client as OClient;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;


class AuthController extends Controller
{

    public $successStatus = 200;

    // use ResetsPasswords;
    // use SendsPasswordResetEmails;
    /**
     * @OA\Post(
     *     path="/api/auth/login",
     *     description="Login a user with username and password",
     *     tags={"Auth"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AuthResponse")
     *     ),
     *     security={ {"bearer": {}} }
     * )
     */
    /**
     * Get a passportToken via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);
        $credentials = request(['username', 'password']);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('username', $request->username)->first();


        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $objTken=$user->createToken(env('PASSPORT_PERSONAL_ACCESS_CLIENT_SECRET'));
                $token = $objTken->accessToken;
                $expiration = $objTken->token->expires_at->diffInSeconds(Carbon::now());
                $response = [
                            'token_type' => 'Bearer',
                            'accessToken' => $token,
                            'user_data' =>  $user->load('roles'),
                            'expires_at'=>$expiration
                        ];
               // $user->assignRole('admin');
                return response($response, 200);
            } else {
                $response = ["message" => "Mot de passe incorrect !"];
                return response($response, 422);
            }
        } else {
            $response = ["message" =>'Cet utilisateur n\'existe pas.'];
            return response($response, 422);
        }
    }
    /**
     * @OA\Post(
     *     path="/api/auth/logout",
     *     description="Logout a user",
     *     tags={"Auth"},
     *     @OA\Response(response=200, description="Ok"),
     *     security={ {"bearer": {}} }
     * )
     */
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'Vous avez été déconnecté avec succès !'];
        return response($response, 200);

    }
    /**
     * @OA\Get(
     *     path="/api/auth/me",
     *     description="Return logged in user information",
     *     tags={"Auth"},
     *     @OA\Response(response=200, description="Ok"),
     *     security={ {"bearer": {}} }
     * )
     */
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(['data' => auth()->user()->load('roles')], 200);
    }

    public function updateProfile(UpdateUserRequest $request)
    {
        $this->authorize('update', User::class);
        $user=auth()->user();
        $user = $this->userService->update($user, $request->validated());
        return new UserResource($user);
    }

  /**
     * @OA\POST(
     *     path="/api/auth/changePassword",
     *     description="ChangePassword",
     *     tags={"Auth"},
     *     @OA\Response(response=200, description="Ok"),
     *     security={ {"bearer": {}} }
     *
     *   @OA\Parameter(
     *          name="User",
     *          description="old_password , new_password and  confirm_password as input",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     * )
     */
    public function changePassword(Request $request)
    {
        $input = $request->all();
        $userid = Auth::guard('api')->user()->id;
        $rules = array(
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                if ((Hash::check(request('old_password'), Auth::user()->password)) == false) {
                    $arr = array("status" => 400, "message" => "Vérifiez votre ancien mot de passe.", "data" => array());
                } else if ((Hash::check(request('new_password'), Auth::user()->password)) == true) {
                    $arr = array("status" => 400, "message" => "Veuillez saisir un mot de passe différent du mot de passe actuel.", "data" => array());
                } else {
                    User::where('id', $userid)->update(['password' => Hash::make($input['new_password'])]);
                    $arr = array("status" => 200, "message" => "Mot de passe mis à jour avec succès.", "data" => array());
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "message" => $msg,
                            ['data' => auth()->user()->load('roles')]);
            }
        }
        return \Response::json($arr);
    }


    public function forgotPassword(Request $request)
{
    $input = $request->all();
    $rules = array(
        'email' => "required|email",
    );
    $validator = Validator::make($input, $rules);
    if ($validator->fails()) {
        $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
    } else {
        try {
            $response = Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject($this->getEmailSubject());
            });
            switch ($response) {
                case Password::RESET_LINK_SENT:
                    return \Response::json(array("status" => 200, "message" => trans($response), "data" => array()));
                case Password::INVALID_USER:
                    return \Response::json(array("status" => 400, "message" => trans($response), "data" => array()));
            }
        } catch (\Swift_TransportException $ex) {
            $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
        } catch (Exception $ex) {
            $arr = array("status" => 400, "message" => $ex->getMessage(), "data" => []);
        }
    }
    return \Response::json($arr);
}



public function loginUsingRefresh()
{
    if (Auth::attempt(['username' => request('username'), 'password' => request('password')])) {
        return $this->getTokenAndRefreshToken(request('username'), request('password'));
    }
    else {
        return response()->json(['error'=>'Unauthorised'], 401);
    }
}


public function getTokenAndRefreshToken($email, $password) {
    $oClient = OClient::where('password_client', 1)->first();
    $http = new Client;
    $response = $http->request('POST', env('APP_URL').'/oauth/token', [
        'form_params' => [
            'grant_type' => 'password',
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
            'username' => $email,
            'password' => $password,
            'scope' => '*',
        ],
    ]);

    $result = json_decode((string) $response->getBody(), true);
    return response()->json($result, $this->successStatus);
}

}
