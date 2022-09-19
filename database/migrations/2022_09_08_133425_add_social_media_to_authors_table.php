<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSocialMediaToAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('authors', function (Blueprint $table) {
            if (!Schema::hasColumn('authors', 'link_facebook')) {
                $table->string('link_facebook');
            }

            if (!Schema::hasColumn('authors', 'link_twitter')) {
                $table->string('link_twitter')->after('link_facebook');
            }
            if (!Schema::hasColumn('authors', 'link_youtube')) {
                $table->string('link_youtube')->after('link_twitter');
            }

            if (!Schema::hasColumn('authors', 'link_Instagram')) {
                $table->string('link_Instagram')->after('link_youtube');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->dropColumn('link_facebook');
            $table->dropColumn('link_twitter');
            $table->dropColumn('link_youtube');
            $table->dropColumn('link_Instagram');
        });
    }
}
