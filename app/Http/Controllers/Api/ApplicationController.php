<?php

namespace App\Http\Controllers\Api;

use App\Models\Client;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;


class ApplicationController extends Controller
{
    public function index(Request $request) {
        $clients=Client::orderByDesc('created_at')->paginate(15);
        return $clients;

    }
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
        'name' => 'required',
        'redirect' => 'required',
        ]);
        if($validator->fails()){
            return response([
                "success" => false,
                "message" => "Validation Error.",
                "error"=>$validator->errors()
            ],400);

        }
        $input['secret']= Str::uuid();
        $input['personal_access_client']=1;
        $input['password_client']=0;
        $input['revoked']=0;




        $data = Client::create($input);
        return response([
            "success" => true,
            "message" => "Application created successfully.",
            "data" => $data
        ],200);

    }
    public function get(Request $request,$id)
    {
        $data = Client::find($id);
        if (is_null($data)) {
            return response([
                "success" => false,
                "message" => "Application not found.",
            ],404);
        }
        return response([
            "success" => true,
            "message" => "Application retrieved successfully.",
            "data" => $data
        ],200);

    }
    public function update(Request $request, Application $data)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'client_id' => 'required',
         //   'client_secret' => 'required',
            'return_url' => 'required',
        ]);
        if($validator->fails()){
        return response([
                "success" => false,
                "message" => "Validation Error.",
                "error"=>$validator->errors()
            ],400);
        }

        $data->name = $input['name'];
        $data->client_id = $input['client_id'];
        $data->return_url = $input['return_url'];
        //$data->client_secret = $input['client_secret'];
        $data->client_secret=Client::find($input["client_id"])->client_secret==null?"test":Client::find($input["client_id"])->client_secret;
        $data->save();
        return response([
            "success" => true,
            "message" => "Application updated successfully.",
            "data" => $data
        ],200);
    }
    public function delete(Request $request,Application $data)
    {
        $data->delete();
        return response([
            "success" => true,
            "message" => "Application deleted successfully.",
            "data" => $data
        ]);
    }
}
