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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id(); // id INT(11) unsigned AUTO_INCREMENT

            $table->unsignedInteger('role_id');
            $table->unsignedInteger('menu_id');

            // Bit-like permissions (use BOOLEAN or TINYINT(1) in Laravel)
            $table->boolean('allow_create')->default(false);
            $table->boolean('allow_read')->default(false);
            $table->boolean('allow_update')->default(false);
            $table->boolean('allow_delete')->default(false);

            // Foreign keys
            $table->foreign('role_id')->references('id')->on('roles')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('menu_id')->references('id')->on('menus')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
