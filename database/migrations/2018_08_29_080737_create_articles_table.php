<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->engine = 'InnoDB';
            $table->string('title')->comment('标题');
            $table->string('intro')->comment('简介');
            $table->string('image')->comment('图片');
            $table->text('content')->comment('文章内容');
            $table->integer('views')->comment('浏览次数')->default(0);
            $table->integer('user_id')->comment('用户id');
            $table->integer('zan')->comment('点赞数')->default(0);
            $table->integer('cate_id')->comment('分类id');
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
        Schema::dropIfExists('articles');
    }
}
