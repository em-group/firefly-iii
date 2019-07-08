<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWhitelabelConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('whitelabel_configs')) {
            Schema::create('whitelabel_configs', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('whitelabel_id');
                $table->string('name', 100)->index();
                $table->string('value', 240);

                $table->unique(['whitelabel_id', 'name']);
                $table->foreign('whitelabel_id')->references('id')->on('whitelabels')->onDelete('cascade');
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
        Schema::dropIfExists('whitelabel_configs');
    }
}
