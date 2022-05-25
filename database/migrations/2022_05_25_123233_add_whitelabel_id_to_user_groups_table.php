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
        Schema::table('user_groups', function (Blueprint $table) {
            $table->unsignedInteger('whitelabel_id');
            $table->foreign('whitelabel_id')->references('id')->on('whitelabels')->onDelete('cascade');
            $table->dropUnique(['title']);
            $table->unique(['whitelabel_id', 'title']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_groups', function (Blueprint $table) {
            $table->dropForeign(['whitelabel_id']);
            $table->dropUnique(['whitelabel_id', 'title']);
            $table->dropColumn('whitelabel_id');
            $table->unique('title');
        });
    }
};
