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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id(); // id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY

            $table->string('currency', 24);
            $table->char('code', 3);
            $table->char('symbol', 4);

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
            $table->unsignedInteger('deleted_by')->nullable();

            // Timestamps and deleted_at
            $table->timestamp('created_at')->useCurrent(); // DEFAULT CURRENT_TIMESTAMP
            $table->timestamp('updated_at')->useCurrentOnUpdate()->useCurrent(); // ON UPDATE CURRENT_TIMESTAMP
            $table->timestamp('deleted_at')->nullable();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
