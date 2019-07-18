<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookSpiberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_spider', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('b_id');// 图书id
            $table->string('site_url','255'); // 采集的站点
            $table->string('info_url','255'); // 采集的图书主页
            $table->string('list_url','255'); // 采集的列表页面
            $table->string('detail_url','255'); //采集的详情页 仅供参考 通配符 暂留
            $table->string('info_rule','255'); // 图片 简介等  暂留
            $table->string('list_rule','255'); // 采集detail 列表
            $table->string('detail_rule','255'); // 采集内容
            $table->integer('order');// 采集的顺序 如果其中一个挂了 可以选用其他的采集规则
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
        Schema::dropIfExists('book_spider');
    }
}
