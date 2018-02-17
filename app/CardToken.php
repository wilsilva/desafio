<?php

namespace DesafioTecnicoMoip;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use phpseclib\Crypt\RSA;

class CardToken extends Model {
	//
	protected $hidden = ['private_token', 'id'];

	public function generateToken() {

		$rsa = new RSA();
		$rsa->setEncryptionMode(RSA::ENCRYPTION_PKCS1);

		extract($rsa->createKey());

		$this->public_token = $publickey;
		$this->private_token = $privatekey;
	}

	public function decodeCreditCard($creditCard) {
		$creditCard = base64_decode($creditCard);

		try {
			$rsa = new RSA();
			$rsa->setEncryptionMode(RSA::ENCRYPTION_PKCS1);

			$rsa->loadKey($this->private_token);

			return $rsa->decrypt($creditCard);
		} catch (\Exception $error) {
			dd($error);
			Log::error($error->getMessage());
			return false;
		}
	}
}
