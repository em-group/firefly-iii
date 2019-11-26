<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPropertiesToHubMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hub_memberships', function (Blueprint $table) {
            $table->json('properties')->nullable();
        });

        Schema::table('users', function(Blueprint $table) {
            $table->dropColumn('product_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hub_memberships', function (Blueprint $table) {
            $table->dropColumn('properties');
        });

        Schema::table('users', function(Blueprint $table) {
            $table->unsignedInteger('product_index')->default(0);
        });
    }
}
