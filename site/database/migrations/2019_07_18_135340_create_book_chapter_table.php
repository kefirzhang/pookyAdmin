<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookChapterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_chapter', function (Blueprint $table) {
            $table->bigIncrements('id'); //章节id
            $table->bigInteger('b_id'); //图书id
            $table->bigInteger('bs_id'); //采集规则id
            $table->longText('content'); //采集的内容
            $table->integer('ref_id');
            $table->integer('order');
            $table->timestamps();
            $table->index(['b_id','bs_id','ref_id']);
            $table->index(['b_id','bs_id','order']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_chapter');
    }
}
