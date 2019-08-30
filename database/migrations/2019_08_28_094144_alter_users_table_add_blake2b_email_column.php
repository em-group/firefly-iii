<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsersTableAddBlake2bEmailColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->char('blake2b_email', 64)->nullable()->default(null);
            $table->unsignedInteger('country_id')->nullable()->default(null);
            $table->string('email', 255)->nullable()->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('blake2b_email');
            $table->dropColumn('country_id');
            $table->string('email', 255)->change();
        });
    }
}
