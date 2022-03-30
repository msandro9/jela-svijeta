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
        Schema::create('meal_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meal_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title');
            $table->text('description');

            $table->unique(['meal_id', 'locale']);

            $table->foreign('meal_id')
                ->references('id')
                ->on('meals')
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
        Schema::dropIfExists('meal_translations');
    }
};
