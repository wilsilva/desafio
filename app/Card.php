<?php

namespace DesafioTecnicoMoip;

use CreditCard;
use DesafioTecnicoMoip\CardToken;
use DesafioTecnicoMoip\Payment;
use Illuminate\Database\Eloquent\Model;

class Card extends Model {
	//

	protected $hidden = ['card_number', 'cvv', 'pivot'];
	protected $appends = ['credit_card_masked', 'cvv_masked'];

	public function payment() {
		return $this->belongsToMany(Payment::class, 'payment_card', 'payment_id', 'card_id');
	}

	public function getCreditCardMaskedAttribute() {
		return '000.0000.000-00';
	}

	public function getCvvMaskedAttribute() {
		return 'xxx';
	}

	public function isValid($buyerId) {
		$cardToken = CardToken::where('buyer_id', $buyerId)->first();

		if (empty($cardToken)) {
			return false;
		}

		$creditCard = $cardToken->decodeCreditCard(base64_decode($this->card_number));

		if (!$creditCard) {
			return false;
		}

		$cardValidated = CreditCard::validCreditCard($creditCard);

		if ($cardValidated['valid']) {
			return true;
		}

		return false;
	}
}
