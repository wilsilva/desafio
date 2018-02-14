<?php

namespace DesafioTecnicoMoip\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use CreditCard;
use DesafioTecnicoMoip\CardToken;

class CardController extends Controller
{
    public function validateCard(Request $request){
        $cardToken = CardToken::where('buyer_id', $request->input('buyer_id'))->first();

        if(empty($cardToken)) return response()->json([
            'error' => 'Token não encontrado.'
        ], 404);

        $creditCard = $cardToken->decodeCreditCard(base64_decode($request->input('credit_card')));
    
        if(!$creditCard) return response()->json([
            'error' => 'Houve um problema ao decodificar o número do cartão de crédito.'
        ], 500);

        $cardValidated = CreditCard::validCreditCard($creditCard);
        unset($cardValidated['number']);
        
        return response()->json($cardValidated);
    }

    public function generateToken(Request $request){
        
        try{
 
            $cardToken = CardToken::where('buyer_id', $request->input('buyer_id'))->first(); 

            if(empty($cardToken)){
                $cardToken = new CardToken;
                $cardToken->buyer_id = $request->input('buyer_id');
                $cardToken->generateToken();
                $cardToken->save();
            }

            return response()->json([
                'token' => $cardToken
            ]);

        }catch(\Excpetion $error){
            Log::error($error->getMessage());
            return response()->json([
                'error' => 'Sistema gerou um erro ao gerar o token para o usuário.'
            ], 500);
        }
    }
}
