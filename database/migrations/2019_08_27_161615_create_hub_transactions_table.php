<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHubTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('hub_transactions')) {
            Schema::create('hub_transactions', function (Blueprint $table) {
                $table->increments('id');
                $table->boolean('success')->nullable()->default(null);
                $table->unsignedInteger('user_id');
                $table->unsignedDecimal('amount', 10, 2)->default('0.00');
                $table->string('currency', 4)->default('');
                $table->string('external_transaction_number', 255)->default('');
                $table->unsignedSmallInteger('offer_id')->default(0);
                $table->dateTime('refunded_at')->nullable()->default(null);
                $table->dateTime('chargeback_at')->nullable()->default(null);
                $table->dateTime('chargeback_stamp')->nullable()->default(null);
                $table->timestamps();
                $table->softDeletes();

                $table->index('user_id');
                $table->index('amount');
                $table->index('external_transaction_number');
                $table->index('offer_id');
                $table->index('chargeback_stamp');
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
        Schema::dropIfExists('hub_transactions');
    }
}
