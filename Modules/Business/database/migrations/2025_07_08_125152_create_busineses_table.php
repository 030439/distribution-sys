<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('busineses', function (Blueprint $table) {
            $table->id();

            $table->string('logo', 40)->nullable();
            $table->string('first_name', 48);
            $table->string('last_name', 255)->nullable();
            $table->string('phone', 16)->nullable();
            $table->string('fax', 16)->nullable();
            $table->string('email', 255);
            $table->string('address', 200)->nullable();
            $table->string('business_name', 200);
            $table->enum('business_size', ['Single Section', 'Multiple Section'])->default('Single Section');

            $table->unsignedInteger('time_zone_id')->nullable();
            $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
            $table->unsignedInteger('currency_id')->nullable();
            $table->unsignedInteger('application_id')->nullable();

            $table->string('instagram', 255)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('facebook', 255)->nullable();

            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->dateTime('deleted_at')->nullable();

            // Foreign key constraints
            // $table->foreign('time_zone_id')->references('id')->on('timezones')->onDelete('restrict')->onUpdate('restrict');
            // $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('restrict')->onUpdate('restrict');
            // $table->foreign('updated_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            // $table->foreign('deleted_by')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('busineses');
    }
};
