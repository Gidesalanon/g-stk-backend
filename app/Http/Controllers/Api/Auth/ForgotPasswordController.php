<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */
    use ResetsPasswords;
    // use SendsPasswordResetEmails;
    /**
     * @OA\Post(
     *     path="/api/auth/password/email",
     *     description="Send reset link Response",
     *     tags={"Auth"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(ref="#/components/schemas/AuthResponse")
     *     ),
     *     security={ {"bearer": {}} }
     * )
     */
    // protected function sendResetLinkResponse(Request $request, $response)
    // {
    //     return response(['message'=> $response]);

    // }


    // protected function sendResetLinkFailedResponse(Request $request, $response)
    // {
    //     return response(['error'=> $response], 422);

    // }


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

}
