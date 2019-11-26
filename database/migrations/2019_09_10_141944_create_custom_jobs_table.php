<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('cron_url.custom_jobs')) {
            Schema::create('cron_url.custom_jobs', function (Blueprint $table) {
                $table->increments('id');
                $table->string('url')->nullable()->default(null);
                $table->enum('method', ['GET','POST'])->nullable()->default(null);
                $table->text('body')->nullable();
                $table->dateTime('created_at')->nullable()->default(null);
                $table->dateTime('success_called_at')->nullable()->default(null);
                $table->string('error_msg')->nullable()->default(null);
                $table->string('domain')->nullable()->default(null);
                $table->unsignedInteger('profile_id')->nullable()->default(null);
                $table->string('key', 64)->nullable()->default(null);

                $table->index('success_called_at');
                $table->index('domain');
                $table->index('profile_id');
                $table->index('key');
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
        // Don't remove the table, once set up
    }
}
