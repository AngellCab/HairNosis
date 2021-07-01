<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->integer('location_id');
            $table->integer('stylist_id');
            $table->integer('modby')
                ->unsigned()
                ->default(0);
            $table->integer('createdby')
                ->unsigned()
                ->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')
                ->references('id')
                ->on('clients');
            $table->longText('formula')->nullable();
            $table->date('apply_date')->nullable();
            $table->string('redken_products')->nullable();
            $table->string('loreal_products')->nullable();
            $table->string('kerestase_products')->nullable();
            $table->string('treatments')->nullable();
            $table->integer('modby')
                ->unsigned()
                ->default(0);
            $table->integer('createdby')
                ->unsigned()
                ->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('diagnoses', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')
                ->references('id')
                ->on('clients');
            $table->string('diagnosis_type')->nullable();
            $table->date('apply_date')->nullable();
            $table->string('spa_visits')->nullable();
            $table->string('versatility')->nullable();
            $table->string('nails_feeling')->nullable();
            $table->longtext('nails_dislikes')->nullable();
            $table->longtext('products_used')->nullable();
            $table->longtext('nail_type')->nullable();
            $table->string('final_diagnosis')->nullable();

            $table->string('personal_style')->nullable();
            $table->string('professional_style')->nullable();
            $table->longtext('personal_interestings')->nullable();
            $table->string('hair_goals')->nullable();
            $table->string('salon_visits')->nullable();
            $table->string('hairstyle_time')->nullable();
            $table->string('hair_versatility')->nullable();
            $table->string('how_hairstyle')->nullable();
            $table->string('hair_comfort')->nullable();
            $table->longtext('hair_likes_dislikes')->nullable();
            $table->longtext('hair_products_used')->nullable();
            $table->string('hair_abundance')->nullable();
            $table->string('diameter')->nullable();
            $table->string('hair_shape')->nullable();
            $table->string('condition')->nullable();
            $table->string('damage_type')->nullable();
            $table->string('face_type')->nullable();
            $table->string('skin_tone')->nullable();
            $table->string('previous_chemical_services')->nullable();

            $table->integer('modby')
                ->unsigned()
                ->default(0);
            $table->integer('createdby')
                ->unsigned()
                ->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('diagnosis_options_name', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('modby')
                ->unsigned()
                ->default(0);
            $table->integer('createdby')
                ->unsigned()
                ->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('diagnosis_options', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('options_name_id')
                ->unsigned()
                ->default(0);
            $table->foreign('options_name_id')
                ->references('id')
                ->on('diagnosis_options_name')
                ->onDelete('cascade');
            $table->string('label');
            $table->integer('modby')
                ->unsigned()
                ->default(0);
            $table->integer('createdby')
                ->unsigned()
                ->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('brand_id');
            $table->string('url_image')->nullable();
            $table->integer('modby')
                ->unsigned()
                ->default(0);
            $table->integer('createdby')
                ->unsigned()
                ->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')
                ->references('id')
                ->on('clients');
            $table->integer('location_id')->nullable();
            $table->date('apply_date')->nullable();
            $table->string('hour')->nullable();
            $table->string('appointment_reason')->nullable();
            $table->string('status')->nullable();
            $table->integer('modby')
                ->unsigned()
                ->default(0);
            $table->integer('createdby')
                ->unsigned()
                ->default(0);
            $table->timestamps();
            $table->softDeletes();
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_helpers');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('products');
        Schema::dropIfExists('diagnoses');
        Schema::dropIfExists('diagnosis_options');
        Schema::dropIfExists('diagnosis_options_name');
        Schema::dropIfExists('services');
        Schema::dropIfExists('clients');
    }
}
