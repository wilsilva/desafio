<?php

namespace DesafioTecnicoMoip\Http\Controllers;

use Illuminate\Http\Request;

use DesafioTecnicoMoip\Http\Requests\ValidateFieldsBuyer;
use DesafioTecnicoMoip\Buyer;

class BuyerController extends Controller
{
    //

    public function create(ValidateFieldsBuyer $request){
        
        $buyer = new Buyer;
        $buyer->client_id = $request->input('client_id');
        $buyer->name = $request->input('name');
        $buyer->email = $request->input('email');
        $buyer->cpf = $request->input('cpf');
        $buyer->save();

        return response()->json([
            "buyer" => $buyer
        ], 201);
    }
}
