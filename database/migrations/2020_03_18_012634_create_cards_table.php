<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('name', 80)->unique();
            $table->string('slug', 45)->unique();
            $table->string('image', 45)->nullable();
            $table->double('limit', 10,2)->nullable();
            $table->double('annual_fee', 10,2)->nullable();
            $table->set('brand', ['visa', 'mastercard', 'elo'])->nullable();
            $table->softDeletes();

            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')
                ->references('id')->on('categories');

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
        Schema::dropIfExists('cards');
    }
}
