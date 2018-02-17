<?php

namespace DesafioTecnicoMoip\Http\Controllers;

use DesafioTecnicoMoip\Boleto;
use DesafioTecnicoMoip\Card;
use DesafioTecnicoMoip\Http\Requests\PaymentWithBoleto;
use DesafioTecnicoMoip\Http\Requests\PaymentWithCreditCard;
use DesafioTecnicoMoip\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller {

	public function paymentWithCreditCard(PaymentWithCreditCard $request) {

		$payment = new Payment;
		$payment->buyer_id = $request->input('buyer_id');
		$payment->type = $request->input('type');
		$payment->amount = $request->input('amount');
		$payment->save();

		$card = new Card;
		$card->holder_name = $request->input('card.holder_name');
		$card->card_number = $request->input('card.card_number');
		$card->expiration_date = $request->input('card.expiration_date');
		$card->cvv = $request->input('card.cvv');
		$card->save();

		$payment->card()->attach($card);

		return response()->json([
			'paymented' => true,
			'message' => 'Pagamento realizado com sucesso!',
			'payment' => Payment::with('Card')->find($payment->id),
		], 201);
	}

	public function paymentWithBoleto(PaymentWithBoleto $request) {

		$payment = new Payment;
		$payment->buyer_id = $request->input('buyer_id');
		$payment->type = $request->input('type');
		$payment->amount = $request->input('amount');
		$payment->save();

		$boleto = new Boleto;
		$boleto->payment_id = $payment->id;
		$boleto->number = rand(12345, 123456789);
		$boleto->save();

		return response()->json([
			'created' => true,
			'message' => 'Boleto gerado com sucesso!',
			'payment' => Payment::with('Boleto')->find($payment->id),
		], 201);
	}

	public function statusPayment(Request $request) {
		$query = collect($request->query());
		$payment = Payment::find(base64_decode($query->first()));

		if (empty($payment)) {
			return response()->json([
				'message' => 'Pagamento não encontrado.',
			], 404);
		}

		switch ($payment->type) {
		case Payment::CARD:
			return response()->json([
				'payment' => Payment::with(['Card', 'Buyer'])->find($payment->id),
			], 200);
		case Payment::BOLETO:
			return response()->json([
				'payment' => Payment::with(['Boleto', 'Buyer'])->find($payment->id),
			], 200);
		default:
			return response()->json([
				'message' => 'Pagamento não encontrado.',
			], 404);
		}
	}
}
