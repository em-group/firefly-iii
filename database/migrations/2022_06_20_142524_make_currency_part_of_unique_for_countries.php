<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeCurrencyPartOfUniqueForCountries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hub_countries', function (Blueprint $table) {
            $table->dropUnique(['abbrev']);
            $table->unique(['abbrev','iso_currency']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hub_countries', function (Blueprint $table) {
            $table->dropUnique(['abbrev','iso_currency']);
            $table->unique('abbrev');
        });
    }
}
