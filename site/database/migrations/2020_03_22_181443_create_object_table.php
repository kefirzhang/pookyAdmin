<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('category_id'); // 所属分类
            $table->string('name'); //对象名称
            $table->string('alias_name')->nullable();//其他名字 用逗号隔开 ,
            $table->text('description'); //描述
            $table->string('cover'); //封面
            $table->integer('type'); //榜单,排名,或者其他 1 奖项 2 排名 3 4 5 6 7
            $table->integer('order')->default("9999"); //排序
            $table->json("options"); //额外新增属性
            $table->timestamps();
            $table->softDeletes();
            $table->index(['category_id', 'order']);
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('object');
    }
}
