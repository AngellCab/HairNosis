<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTablesWithLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('diagnoses', function(Blueprint $table) {

            $table->bigInteger('location_id')
                ->after('client_id')
                ->default(0);
            $table->foreign('location_id')
                ->references('id')
                ->on('locations');
        });

        Schema::table('products', function(Blueprint $table) {
            
            $table->bigInteger('company_id')
                ->after('brand_id')
                ->default(0);
            $table->foreign('company_id')
                ->references('id')
                ->on('companies');
        });

        Schema::table('services', function(Blueprint $table) {
            
            $table->bigInteger('location_id')
                ->after('client_id')
                ->default(0);
            $table->foreign('location_id')
                ->references('id')
                ->on('locations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function(Blueprint $table) {
            $table->dropColumn(['location_id']);
        });

        Schema::table('products', function(Blueprint $table) {
            $table->dropColumn(['company_id']);
        });

        Schema::table('diagnoses', function(Blueprint $table) {
            $table->dropColumn(['location_id']);
        });
    }
}
