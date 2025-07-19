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
        Schema::create('departments', function (Blueprint $table) {
            $table->id(); // INT(11) unsigned AUTO_INCREMENT

            $table->string('department', 50)->nullable();

            $table->enum('status', ['Active', 'Inactive', 'Pending'])->default('Active');

            $table->unsignedTinyInteger('created_by');
            $table->unsignedTinyInteger('updated_by')->nullable();
            $table->unsignedTinyInteger('deleted_by')->nullable();

            // created_at with default CURRENT_TIMESTAMP and updated_at with ON UPDATE
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
            $table->timestamp('deleted_at')->nullable(); // Soft delete compatible
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
