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
        Schema::create('timezones', function (Blueprint $table) {
            $table->id(); // Auto-incrementing UNSIGNED INT(11)
            $table->char('zone_group', 150);
            $table->char('timezone', 48);
            $table->char('php_timezone', 48);
            $table->char('sdt', 9);
            $table->char('dst', 9);
            $table->timestamp('created_at')->useCurrent(); // DEFAULT CURRENT_TIMESTAMP NOT NULL
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timezones');
    }
};
