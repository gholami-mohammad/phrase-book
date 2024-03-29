<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('words', function (Blueprint $table) {
            $table->id();
            $table->string('word', 512)->index();
            $table->string('language_alpha2code', 2);
            $table->bigInteger('created_by_id')->unsigned()->nullable();
            $table->bigInteger('step_id')->unsigned()->nullable();
            $table->integer('success_reviews_count')->default(0);
            $table->integer('fail_reviews_count')->default(0);
            $table->integer('total_reviews_count')->default(0);
            $table->dateTimeTz('last_review')->nullable();
            $table->boolean('archived')->default(false);
            $table->timestampsTz();

            $table->unique(['word', 'language_alpha2code', 'created_by_id']);

            $table->foreign('language_alpha2code')
                ->on('languages')
                ->references('alpha2code')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

            $table->foreign('step_id')
                ->on('steps')
                ->references('id')
                ->onDelete('RESTRICT')
                ->onUpdate('CASCADE');

            $table->foreign('created_by_id')
                ->on('users')
                ->references('id')
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('words');
    }
};
