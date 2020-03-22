<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category', function (Blueprint $table) {
            $table->bigIncrements('id'); // 主键id
            $table->integer('parent_id'); //父类
            $table->string('name'); // 类名
            $table->string('alias_name')->nullable(); // 别名
            $table->text('description'); //描述
            $table->string('cover'); //封面
            $table->integer('order')->default("9999"); //排序 越大越靠后
            $table->json("options"); //额外新增属性
            $table->timestamps();
            $table->softDeletes();
            $table->index(['parent_id','order']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category');
    }
}
