<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('作者名字');
            $table->string('intro')->comment('作者简介');
            $table->text('content')->comment('详细介绍');
            $table->string('qrcode')->comment('二维码');
            $table->string('domain')->comment('域名');
            $table->string('title')->comment('网站名称');
            $table->string('description')->comment('描述');
            $table->string('keywords')->comment('关键字');

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
        Schema::dropIfExists('settings');
    }
}
