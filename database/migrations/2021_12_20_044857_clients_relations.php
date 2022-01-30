<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClientsRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            
            $table->dropColumn(['location_id', 'stylist_id']);
            $table->after('phone', function($table) {
                $table->enum('origin', ['app', 'web'])->default('app');
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
            });
            $table->index('hash');
        });

        Schema::dropIfExists('client_helpers');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            
            $table->dropIndex('clients_hash_index');
            $table->dropColumn(['email_verified_at', 'password', 'remember_token']);
        });

        Schema::create('client_helpers', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')
                ->references('id')
                ->on('clients');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('stylist_id')->nullable();
            $table->integer('type')->nullable();
            $table->integer('type_id')->nullable();
            $table->boolean('status')->nullable();
            $table->integer('modby')
                ->unsigned()
                ->default(0);
            $table->integer('createdby')
                ->unsigned()
                ->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
