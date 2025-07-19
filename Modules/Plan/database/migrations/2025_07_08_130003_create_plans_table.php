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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('role_id')->unsigned()->default(1);
            $table->unsignedInteger('currency_id');
            $table->string('plan', 100);
            $table->text('description');
            $table->decimal('price', 10, 2)->default(0.00);
            $table->text('additional_criteria')->nullable();
            $table->string('discount', 255);
            $table->text('features')->nullable();
            $table->enum('billing_cycle', ['Weekly', 'Monthly', 'Quartely', 'Biannually', 'Yearly'])->default('Weekly');
            $table->enum('show', ['Yes', 'No'])->default('Yes');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->float('sort_order');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->unsignedTinyInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Foreign keys
            // $table->foreign('currency_id')->references('id')->on('tcurrencies')->onDelete('restrict')->onUpdate('restrict');
            // $table->foreign('created_by')->references('id')->on('t17users')->onDelete('restrict')->onUpdate('restrict');
            // $table->foreign('updated_by')->references('id')->on('t17users')->onDelete('restrict')->onUpdate('restrict');
            // $table->foreign('deleted_by')->references('id')->on('t17users')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
