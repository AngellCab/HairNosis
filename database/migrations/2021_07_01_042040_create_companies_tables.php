<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('owner_id');
            $table->foreign('owner_id')
                ->references('id')
                ->on('users');
            $table->integer('modby')
                ->unsigned()
                ->default(0);
            $table->integer('createdby')
                ->unsigned()
                ->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('company_id');
            $table->foreign('company_id')
                ->references('id')
                ->on('companies');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->bigInteger('manager_id');
            $table->foreign('manager_id')
                ->references('id')
                ->on('users');
            $table->integer('modby')
                ->unsigned()
                ->default(0);
            $table->integer('createdby')
                ->unsigned()
                ->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
        Schema::dropIfExists('companies');
    }
}
