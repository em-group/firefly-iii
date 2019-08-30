<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHubUserInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('hub_user_info')) {
            Schema::create('hub_user_info', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id');
                $table->string('firstname', 100)->nullable()->default(null);
                $table->string('lastname', 100)->nullable()->default(null);
                $table->string('address', 255)->nullable()->default(null);
                $table->string('zip', 30)->nullable()->default(null);
                $table->string('city', 255)->nullable()->default(null);
                $table->unsignedInteger('country_id')->nullable()->default(null);
                $table->timestamps();

                $table->unique('user_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hub_user_info');
    }
}
