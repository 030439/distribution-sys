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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            $table->unsignedTinyInteger('parent_menu_id')->nullable();

            $table->string('mtype', 10)->nullable();
            $table->string('mlevel', 20)->nullable();
            $table->string('web_title', 30);
            $table->string('app_title', 30);
            $table->string('web_link', 50)->nullable();
            $table->string('app_link', 255)->nullable();

            // FLOAT(10,2) – In Laravel use 'float' with (total, places)
            $table->float('sort_order', 10, 2);

            $table->unsignedTinyInteger('web_filter')->nullable();
            $table->unsignedTinyInteger('app_filter')->nullable();
            $table->string('web_icon', 50)->nullable();
            $table->string('app_icon', 50)->nullable();

            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
            $table->unsignedInteger('deleted_by')->nullable();

            $table->timestamps(); // created_at & updated_at
            $table->softDeletes(); // deleted_at

            // Foreign key constraints
            // $table->foreign('created_by')->references('id')->on('t17users')->onUpdate('restrict')->onDelete('restrict');
            // $table->foreign('updated_by')->references('id')->on('t17users')->onUpdate('restrict')->onDelete('restrict');
            // $table->foreign('deleted_by')->references('id')->on('t17users')->onUpdate('restrict')->onDelete('restrict');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
