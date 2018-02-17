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
        if(empty(Client::find(1))){
          $client = new Client;
          $client->id = 1;
          $client->save();
        }
    }
}
