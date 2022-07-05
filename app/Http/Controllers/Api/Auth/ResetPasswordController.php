<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\User;



class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;
/**
     * @OA\Post(
     *     path="/api/auth/password/reset",
     *     description="Send reset Response",
     *     tags={"Auth"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AuthResponse")
     *     ),
     *     security={ {"bearer": {}} }
     * )
     */

    protected function sendResetResponse(Request $request, $response)
    {
        return response(['message'=> $response]);

    }

    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response(['error'=> $response], 422);
    }


    public function postEmail(Request $request)
{
    $this->validate($request, ['email' => 'required|email']);

    $response = Password::sendResetLink($request->only('email'), function (Message $message) {
        $message->subject($this->getEmailSubject());
    });

    switch ($response) {
        case Password::RESET_LINK_SENT:
            // return redirect()->back()->with('status', trans($response));
            return response(['message'=> $response]);

        case Password::INVALID_USER:
            // return redirect()->back()->withErrors(['email' => trans($response)]);
            return response(['error'=> $response], 422);
    }
}




public function sendingResetLink(Request $request)
{

    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'link' => 'link|string',
    ]);
    $credentials = request(['email']);
    if ($validator->fails())
    {
        return response(['errors'=>$validator->errors()->all()], 422);
    }
    $user = User::where('email', $request->email)->first();

    if (!$user) {
        return  response()->json([
            'message' => 'Cet email n\'existe pas dans notre base de données.'
        ], 404);
    }
    Mail::to($request->email)
    ->send(new UserPassword($request->except('_token')));

    return  response()->json([
        'message' => 'Mail de réinitialisation de mot de passe envoyé avec success'
    ], 200);


}


public function forgot_password(Request $request)
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

}
