<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHubCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('hub_countries')) {
            Schema::create('hub_countries', function (Blueprint $table) {
                $table->tinyIncrements('id');
                $table->string('abbrev', 5)->default('');
                $table->string('label', 30)->default('');
                $table->boolean('enabled')->default(false);
                $table->string('currency', 25)->default('');
                $table->string('iso_currency', 3)->default('');
                $table->string('locale', 8)->default('');
                $table->decimal('membership_price', 8, 2)->default('0.00');
                $table->decimal('trial_price', 7, 2)->default('0.00');
                $table->string('code', 2)->nullable();

                $table->unique('abbrev');
                $table->index('enabled');
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
        Schema::dropIfExists('hub_countries');
    }
}
