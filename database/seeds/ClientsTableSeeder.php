<?php

use Illuminate\Database\Seeder;
use DesafioTecnicoMoip\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new Client;
        $client->id = 1;
        $client->save();
    }
}
