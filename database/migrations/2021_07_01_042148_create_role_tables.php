<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label')->nullable();
            $table->integer('modby')
                ->unsigned()
                ->default(0);
            $table->integer('createdby')
                ->unsigned()
                ->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('label')->nullable();
            $table->string('description');
            $table->integer('modby')
                ->unsigned()
                ->default(0);
            $table->integer('createdby')
                ->unsigned()
                ->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('permission_role', function (Blueprint $table) {
            $table->bigInteger('permission_id')
                ->unsigned()
                ->default(0);
            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');
            $table->bigInteger('role_id')
                ->unsigned()
                ->default(0);
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');
            $table->integer('modby')
                ->unsigned()
                ->default(0);
            $table->integer('createdby')
                ->unsigned()
                ->default(0);
            $table->timestamps();
            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('role_user', function (Blueprint $table) {
            $table->bigInteger('company_id')
                ->unsigned()
                ->default(0);
            $table->bigInteger('location_id')
                ->unsigned()
                ->default(0);
            $table->bigInteger('role_id')
                ->unsigned()
                ->default(0);
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');
            $table->bigInteger('user_id')
                ->unsigned()
                ->default(0);
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->integer('modby')
                ->unsigned()
                ->default(0);
            $table->integer('createdby')
                ->unsigned()
                ->default(0);
            $table->timestamps();

            $table->primary(['location_id', 'role_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('roles');
    }
}
