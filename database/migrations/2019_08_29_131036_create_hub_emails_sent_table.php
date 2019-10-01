<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHubEmailsSentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('hub_emails_sent')) {
            Schema::create('hub_emails_sent', function (Blueprint $table) {
                $table->increments('id');
                $table->string('from', 64)->default('');
                $table->string('replyto', 64)->default('');
                $table->string('to', 64)->default('');
                $table->string('subject', 255)->default('');
                $table->string('template', 128)->nullable()->default(null);
                $table->mediumText('data');
                $table->dateTime('send_at')->nullable()->default(null);
                $table->dateTime('sent_at')->nullable()->default(null);
                $table->dateTime('read_at')->nullable()->default(null);
                $table->string('read_at_ip', 32)->nullable()->default(null);
                $table->softDeletes();
                $table->timestamps();

                $table->index('from');
                $table->index('to');
                $table->index('subject');
                $table->index('template');
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
        Schema::dropIfExists('hub_emails_sent');
    }
}
