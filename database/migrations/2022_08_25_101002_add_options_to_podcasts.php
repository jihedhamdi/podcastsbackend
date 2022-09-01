<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOptionsToPodcasts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            
            $table->boolean('animation')->nullable()->default(0)->after('status');
            $table->boolean('access')->nullable()->default(0)->after('animation');
            $table->boolean('visible')->nullable()->default(0)->after('access');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
           
            $table->dropColumn('animation');
            $table->dropColumn('access');
            $table->dropColumn('visible');
        });
    }
}
