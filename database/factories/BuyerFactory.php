<?php

use Faker\Generator as Faker;
use DesafioTecnicoMoip\Buyer;
$factory->define(Buyer::class, function (Faker $faker) {
    return [
        'client_id' => 1,
        'name' => $this->faker->name,
        'email' => $this->faker->unique()->safeEmail,
        'cpf' => $this->faker->cpf(false)
    ];
});
