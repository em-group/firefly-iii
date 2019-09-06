<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHubUserSignupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('hub_user_signups')) {
            Schema::create('hub_user_signups', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedInteger('user_id');
                $table->string('browser', 1024)->nullable()->default(null);
                $table->string('ip', 18)->nullable()->default(null);
                $table->string('hostname', 512)->nullable()->default(null);
                $table->string('ref', 255)->nullable()->default(null);
                $table->unsignedSmallInteger('offer_id')->default(0);
                $table->string('extras', 255)->nullable()->default(null);
                $table->timestamps();

                $table->index('user_id');
                $table->index('offer_id');
                $table->index('ref');
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
        Schema::dropIfExists('hub_user_signups');
    }
}
