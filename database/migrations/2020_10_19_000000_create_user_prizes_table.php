<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPrizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_prizes', function (Blueprint $table) {
            $table->id();
            $table->integer('value')->nullable();
            $table->smallInteger('type');
            $table->integer('user_id');
            $table->string('bank_card')->nullable();
            $table->string('phone_number')->nullable();
            $table->smallInteger('card_exp_month')->nullable();
            $table->smallInteger('card_exp_year')->nullable();
            $table->smallInteger('card_cvv')->nullable();
            $table->smallInteger('sent_status');
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
        Schema::dropIfExists('user_prizes');
    }
}
