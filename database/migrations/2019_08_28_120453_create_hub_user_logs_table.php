<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHubUserLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('hub_user_logs')) {
            Schema::create('hub_user_logs', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('membership_id')->nullable()->default(null);
                $table->boolean('admin_action')->default(0);
                $table->enum('action', [
                    'subscribed','unsubscribed','resubscribed',
                    'failed_resubscribed','insert_error_pool','remove_error_pool'
                ])->nullable()->default(null);
                $table->timestamps();

                $table->index('user_id');
                $table->index('action');
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
        Schema::dropIfExists('hub_user_logs');
    }
}
