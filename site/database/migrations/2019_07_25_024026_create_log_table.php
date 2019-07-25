<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('flow','255');// 流水 ----------
            $table->string('module','255'); // 项目 模块 book
            $table->string('intro','255'); // 介绍 图书采集
            $table->bigInteger('code');// 错误码  -1 1
            $table->bigInteger('s_code');// 子错误码 -1 1
            $table->text('content');// 日志内容 采集内容
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
        Schema::dropIfExists('log');
    }
}
