<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHubMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('hub_messages')) {
            Schema::create('hub_messages', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id');
                $table->string('subject', 45)->default('');
                $table->text('content');
                $table->unsignedInteger('transaction_id')->nullable()->default(null);
                $table->dateTime('read_at')->nullable()->default(null);
                $table->timestamps();
                $table->softDeletes();

                $table->index('user_id');
                $table->index('read_at');
                $table->index('transaction_id');
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
        Schema::dropIfExists('hub_messages');
    }
}
