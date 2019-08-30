<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHubEmailChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('hub_email_changes')) {
            Schema::create('hub_email_changes', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id')->nullable()->default(null);
                $table->string('email_from', 128)->nullable()->default(null);
                $table->string('email_to', 128)->nullable()->default(null);
                $table->timestamps();

                $table->index('user_id');
                $table->index('email_from');
                $table->index('email_to');
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
        Schema::dropIfExists('hub_email_changes');
    }
}
