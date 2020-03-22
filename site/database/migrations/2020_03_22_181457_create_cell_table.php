<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCellTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cell', function (Blueprint $table) {
            //本表不用软删除 全部硬删除   cell 数据
            $table->bigIncrements('id');
            $table->integer('instance_id'); //所属实例
            $table->integer('meta_x_id'); //x轴属性坐标
            $table->integer('meta_y_id'); //y轴属性坐标
            $table->text('content')->nullable();// 具体内容 可以为空
            $table->timestamps();
            $table->unique(['instance_id','meta_x_id','meta_y_id']);
            $table->index(['meta_x_id','instance_id']); // 类似 所有最佳男主角是谁 历届最佳男主角
            $table->index(['meta_y_id','instance_id']); //类似
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cell');
    }
}
