<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu', function (Blueprint $table) {

            $table->bigIncrements('id'); //主键
            $table->bigInteger('p_id');// 父类
            $table->string('name','128');//名称
            $table->string('icon','128');//图标 //顶级分类一般才有
            $table->string('action','255');//地址
            $table->string('target','64');//目标窗口
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
        Schema::dropIfExists('menu');
    }
}
