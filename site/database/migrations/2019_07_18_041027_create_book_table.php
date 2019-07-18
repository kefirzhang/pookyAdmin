<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name','128');
            $table->string('category','128');
            $table->string('author','128');
            $table->string('intro','255');
            $table->string('cover','255');
            $table->string('tags','255');
            $table->string('last_chapter','255');
            $table->bigInteger('bs_id');//最后采集的规则id
            $table->integer('finished');
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
        Schema::dropIfExists('book');
    }
}
