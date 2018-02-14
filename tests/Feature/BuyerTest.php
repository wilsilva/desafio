<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BuyerTest extends TestCase
{
    protected $faker;

    public function setUp(){
        parent::setUp();
        $this->faker = \Faker\Factory::create('pt_BR');
    }

    public function testCreateBuyer()
    {
        $response = $this->json('POST','/api/buyers',[
            'client_id' => 1,
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'cpf' => $this->faker->cpf(false)
        ]);
        
        $response->assertStatus(201)
            ->assertJsonStructure([
                'buyer'
            ]);
    }
}
