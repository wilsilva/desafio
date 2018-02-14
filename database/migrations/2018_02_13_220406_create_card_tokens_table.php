<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_tokens', function (Blueprint $table) {
            $table->integer('buyer_id')->unsigned();
            $table->text('public_token');
            $table->text('private_token');

            $table->primary(['buyer_id']);
            $table->foreign('buyer_id')
                ->references('id')->on('buyers');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_tokens');
    }
}
