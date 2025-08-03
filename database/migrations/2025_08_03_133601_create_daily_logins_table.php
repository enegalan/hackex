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
        Schema::create('daily_logins', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->date('login_date');
            $table->timestamps();
            $table->unique(['user_id', 'login_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_logins');
    }
};
