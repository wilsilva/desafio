<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_card', function (Blueprint $table) {
            
            $table->integer('card_id', false, true);
            $table->integer('payment_id', false, true);


            $table->primary(['card_id', 'payment_id']);
            
            $table->foreign('card_id')
                ->references('id')->on('cards');            
            $table->foreign('payment_id')
                ->references('id')->on('payments');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_card');
    }
}
