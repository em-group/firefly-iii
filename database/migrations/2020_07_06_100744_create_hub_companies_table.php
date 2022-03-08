<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHubCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('hub_companies')) {
            Schema::create('hub_companies', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('display_name')->default('');
                $table->string('registration_number')->default('');
                $table->string('address_1')->default('');
                $table->string('address_2')->default('');
                $table->string('address_zip')->default('');
                $table->string('address_city')->default('');
                $table->string('address_country')->default('');
                $table->string('return_address')->default('');
                $table->string('website')->default('');
                $table->string('phone')->default('');
            });

            Schema::table('whitelabels', function(Blueprint $table) {
                $table->unsignedInteger('company_id')->nullable()->default(null);
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
        if(Schema::hasColumn('whitelabels', 'company_id')){
            Schema::table('whitelabels', function(Blueprint $table){
                $table->dropColumn('company_id');
            });
        }

        Schema::dropIfExists('hub_companies');
    }
}
