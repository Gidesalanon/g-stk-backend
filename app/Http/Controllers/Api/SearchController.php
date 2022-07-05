<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entreprise;


class SearchController extends Controller
{

    public function searchAll(Request $request)
    {

        $request->validate([
            "query" => 'required|min:3',
        ]);

        $query = $request->input('query');

        $entreprise =  Entreprise::where([["name","like","%".$query."%"], ["public","=",1]])
        ->orWhere([["presentation","like","%".$query."%"], ["public","=",1]])->get();

        return response()->json([
            "entreprise" => $entreprise,
        ], 200);

    }
    
}
