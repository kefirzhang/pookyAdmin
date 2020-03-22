<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('object_id'); //所属项目
            $table->integer('type');//X轴还是Y轴 1 x轴 2 y轴
            $table->integer('content_type');//内容类型 文字 url图片等等 主要是X轴生效 1 文本 2 图片 其他待确认
            $table->string('name'); //名称 显示名字
            $table->string('alias_name')->nullable();//其他名字 用逗号隔开 ,
            $table->integer('order')->default("9999");
            $table->timestamps();
            $table->softDeletes();
            $table->index(['object_id','type','order']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta');
    }
}
