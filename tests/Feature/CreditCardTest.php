<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use phpseclib\Crypt\RSA;

use DesafioTecnicoMoip\Buyer;

class CreditCardTest extends TestCase
{

    public function testGetToken()
    {
       $buyers = factory(Buyer::class, 1)->create();
       $buyers->each(function ($item, $key) {
            $response = $this->json('POST','/api/cards/token',[
                'buyer_id' => $item->id
            ]);

            $response->assertStatus(200)
                ->assertJsonStructure([
                    'token'
                ]);
        });

        return $buyers;
    }

    /**
     * @depends testGetToken
     */
    public function testGetTokenGenerated($buyers){
    
        $tokens = $buyers->map(function ($item, $key) {
                $response = $this->json('POST','/api/cards/token',[
                    'buyer_id' => $item->id
                ]);

                $response->assertStatus(200)
                    ->assertJsonStructure([
                        'token'
                ]);

                return $response->getContent();
            });

        return $tokens;

    }

    /**
     * @depends testGetTokenGenerated
     */

    public function testValidateNumber($tokens)
    {
        $tokens->each(function($item, $key){
            $item  = json_decode($item);

            $rsa = new RSA();
            $rsa->loadKey($item->token->public_token);
            $ciphertext = $rsa->encrypt("4929211732937456");
        
            $response = $this->json('POST','/api/cards/validate',[
                'buyer_id' => $item->token->buyer_id,
                'credit_card' => base64_encode($ciphertext),
                
            ]);
            
            $response->assertStatus(200)->assertJson([
                'valid' => true,
                'type' => 'visa'
            ]);

        });
    }
}
