<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use phpseclib\Crypt\RSA;

use DesafioTecnicoMoip\Buyer;

class PaymentTest extends TestCase
{
    protected $faker;
    protected $buyer;

    public function setUp(){
        parent::setUp();
        $this->faker = \Faker\Factory::create('pt_BR');
        $this->buyer = factory(Buyer::class, 1)->create()->first();
    }
    
    public function testPaymentWithCreditCard()
    {
        $responseToken = $this->json('POST','/api/cards/token',[
            'buyer_id' => $this->buyer->id
        ])
        ->assertStatus(200)
        ->decodeResponseJson();

        $rsa = new RSA();
        $rsa->loadKey($responseToken["token"]["public_token"]);
        $cardNumber = base64_encode($rsa->encrypt($this->faker->creditCardNumber));
        $cvv = base64_encode($rsa->encrypt($this->faker->numberBetween($min = 100, $max = 999)));

        $response = $this->json('POST','/api/payments/creditcard',[
            'buyer_id' => $this->buyer->id,
            'type' => 'card',
            'amount' => 1.99,
            'card' => [
                'holder_name' => $this->faker->name,
                'card_number' => $cardNumber,
                'expiration_date' => $this->faker->creditCardExpirationDateString,
                'cvv' => $cvv
            ]
        ])
        ->assertStatus(201)
        ->assertJson([
            'paymented' => true,
            'message' => 'Pagamento realizado com sucesso!'
        ]);

        return $response->decodeResponseJson();
    }

    public function testPaymentWithBoleto(){

        $response = $this->json('POST','/api/payments/boleto',[
            'buyer_id' => $this->buyer->id,
            'type' => 'boleto',
            'amount' => 1.99
        ])
        ->assertStatus(201)
        ->assertJson([
            'created' => true,
            'message' => 'Boleto gerado com sucesso!'
        ]);

        return $response->decodeResponseJson();

    }

    /**
     * @depends testPaymentWithBoleto
     */
    public function testStatusPaymentBoleto($paymentedBoleto){
        $response =  $this->get('/api/payments/status?payment=' . base64_encode($paymentedBoleto['payment']['id']))
        ->assertStatus(200);
    }

    /**
     * @depends testPaymentWithCreditCard
     */
    public function testStatusPaymentCreditCard($paymentedCreditCard){
        $response =  $this->get('/api/payments/status?payment=' . base64_encode($paymentedCreditCard['payment']['id']))
        ->assertStatus(200);

        dd('/api/payments/status?payment=' . base64_encode($paymentedCreditCard['payment']['id']));
    }
    
}
