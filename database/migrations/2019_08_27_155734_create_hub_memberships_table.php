<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHubMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('hub_memberships')) {
            Schema::create('hub_memberships', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id');
                $table->unsignedInteger('transaction_id')->default(0);
                $table->dateTime('expires_at')->nullable()->default(null);
                $table->dateTime('failed_at')->nullable()->default(null);
                $table->unsignedSmallInteger('error_tries')->default(0);
                $table->softDeletes();
                $table->timestamps();

                $table->index('user_id');
                $table->index('transaction_id');
                $table->index('expires_at');
                $table->index('failed_at');
                $table->index('error_tries');
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
        Schema::dropIfExists('hub_memberships');
    }
}
