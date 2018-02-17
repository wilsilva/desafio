<?php

namespace DesafioTecnicoMoip\Http\Controllers;

use CreditCard;
use DesafioTecnicoMoip\CardToken;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CardController extends Controller {

	public function validateCard(Request $request) {
		$cardToken = CardToken::where('buyer_id', $request->input('buyer_id'))->first();

		if (empty($cardToken)) {
			return response()->json([
				'error' => 'Token não encontrado.',
			], 404);
		}

		$creditCard = $cardToken->decodeCreditCard(base64_decode($request->input('credit_card')));

		if (!$creditCard) {
			return response()->json([
				'error' => 'Houve um problema ao decodificar o número do cartão de crédito.',
			], 500);
		}

		$cardValidated = CreditCard::validCreditCard($creditCard);

		if ($cardValidated['valid']) {
			$imgPath = public_path('img/creditcards/' . $cardValidated['type'] . '.png');
			$imgData = file_get_contents($imgPath);
			$type = pathinfo($imgPath, PATHINFO_EXTENSION);
			$imgbase64 = 'data:image/' . $type . ';base64,' . base64_encode($imgData);
			$cardValidated['image'] = $imgbase64;
		}

		unset($cardValidated['number']);

		return response()->json($cardValidated);
	}

	public function generateToken(Request $request) {

		try {

			$cardToken = CardToken::where('buyer_id', $request->input('buyer_id'))->first();

			if (empty($cardToken)) {
				$cardToken = new CardToken;
				$cardToken->buyer_id = $request->input('buyer_id');
				$cardToken->generateToken();
				$cardToken->save();
			}

			return response()->json([
				'token' => $cardToken,
			]);

		} catch (\Excpetion $error) {
			Log::error($error->getMessage());
			return response()->json([
				'error' => 'Sistema gerou um erro ao gerar o token para o usuário.',
			], 500);
		}
	}
}
