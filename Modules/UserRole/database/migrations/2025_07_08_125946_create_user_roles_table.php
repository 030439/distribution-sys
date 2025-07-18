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
        Schema::create('userroles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('role_id');
            $table->unsignedBigInteger('app_id');
            $table->timestamp('created_at')->useCurrent();

            // Foreign keys
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('role_id')
                ->references('id')->on('roles')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->foreign('app_id')
                ->references('id')->on('busineses')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userroles');
    }
};
