<?php

namespace DesafioTecnicoMoip;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;

use phpseclib\Crypt\RSA;

class CardToken extends Model
{
    //
    protected $hidden = ['private_token'];

    public function generateToken(){
        
        $rsa = new RSA();
        $rsa->setPublicKeyFormat(RSA::PUBLIC_FORMAT_OPENSSH);
        
        extract($rsa->createKey());

        $this->public_token = $publickey;
        $this->private_token = $privatekey;
    }

    public function decodeCreditCard($creditCard){
        
        try{
            $rsa = new RSA();
            $rsa->loadKey($this->private_token);
            
            return $rsa->decrypt($creditCard);
        }catch(\Exception $error){
            Log::error($error->getMessage());
            return false;
        }
    }
}
