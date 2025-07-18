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
        Schema::create('designations', function (Blueprint $table) {
            $table->id(); // id INT(11) AUTO_INCREMENT PRIMARY KEY

            $table->unsignedInteger('department_id'); // FK to t15department
            $table->string('designation', 50)->nullable();

            $table->enum('status', ['Active', 'Inactive', 'Pending'])->default('Active');

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();

            $table->timestamp('created_at')->useCurrent(); // DEFAULT CURRENT_TIMESTAMP
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate(); // ON UPDATE CURRENT_TIMESTAMP
            $table->timestamp('deleted_at')->nullable();

            // Foreign key constraints
            $table->foreign('department_id')->references('id')->on('departments')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('deleted_by')->references('id')->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('designations');
    }
};
