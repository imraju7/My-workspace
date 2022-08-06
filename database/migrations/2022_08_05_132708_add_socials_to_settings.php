<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('facebook_handle')->default(NUll)->after('address');
            $table->string('twitter_handle')->default(NULL)->after('address');
            $table->string('linkedin_handle')->default(NULL)->after('address');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('facebook_handle');
            $table->dropColumn('twitter_handle');
            $table->dropColumn('linkedin_handle');
        });
    }
};
