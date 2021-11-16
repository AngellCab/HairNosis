<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHashColumnTables extends Migration
{
    private $tables = [
        'appointments', 
        'clients', 
        'companies', 
        'diagnosis_options',
        'locations',
        'products',
        'services',
        'users'
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach($this->tables as $t) {
            Schema::table($t, function(Blueprint $table) {
                $table->string('hash')
                    ->before('created_at')
                    ->nullable();
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
        foreach($this->tables as $t) {
            Schema::table($t, function(Blueprint $table) {
                $table->dropColumn(['hash']);
            });
        }
    }
}
