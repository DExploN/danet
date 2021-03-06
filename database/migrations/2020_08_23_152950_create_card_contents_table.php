<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'card_contents',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('card_id');
                $table->char('lang', 3);
                $table->string('title')->nullable(true);
                $table->text('question')->nullable(true);
                $table->text('answer')->nullable(true);
                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('card_contents');
    }
}
