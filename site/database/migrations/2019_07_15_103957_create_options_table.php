<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->bigIncrements('id'); //主键 自增
            $table->string('name','255'); //配置名称
            $table->string('alias_name','255'); //配置别名
            $table->longText('value'); //配置内容
            //$table->string('autoload','20'); //是否自动加载
            $table->integer('autoload'); // 所属分类
            $table->timestamps();
            $table->index('name'); //索引
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
}
