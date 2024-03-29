<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ingredient_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');

            $table->unique(['ingredient_id', 'locale']);

            $table->foreign('ingredient_id')
                ->references('id')
                ->on('ingredients')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('locale')
                ->references('locale')
                ->on('languages')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredient_translations');
    }
};
