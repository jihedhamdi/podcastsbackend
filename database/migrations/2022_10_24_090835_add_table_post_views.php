<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTablePostViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_views', function (Blueprint $table) {
            //
        $table->increments("id");
        $table->unsignedInteger("post_id");
        $table->string("titleslug");
        $table->string("url");
        $table->string("session_id");
        $table->unsignedInteger('user_id')->nullable();
        $table->string("ip");
        $table->string("agent");
        $table->timestamps();
        $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_views');;
    }
}
