<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
         Schema::create('t17users', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key (INT, unsigned)
            $table->string('user_name', 255);
            $table->string('password', 255);
            $table->enum('user_type', ['admin', 'user', 'company','staff'])->default('user');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->unsignedInteger('uonline')->nullable();
            $table->dateTime('last_active_timestamp')->nullable();
            $table->unsignedInteger('app_id')->nullable();
            $table->string('reset_link', 50)->nullable();
            $table->boolean('force_password_reset')->default(false)->nullable();
            $table->string('activate_hash', 50)->nullable();
            $table->dateTime('reset_expires')->nullable();
            $table->dateTime('reset_at')->nullable();
            $table->string('reset_hash', 50)->nullable();
            $table->boolean('verified')->default(false);
            $table->text('google_id')->nullable();
            $table->timestamps(); // creates 'created_at' and 'updated_at'
            $table->softDeletes(); // creates 'deleted_at'
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t17users');
    }
};
