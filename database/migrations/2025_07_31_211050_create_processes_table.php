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
        Schema::create('bypasses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('victim_id');
            $table->tinyInteger('status')->default(0); // 0 = working, 1 = successful, 2 = failed
            $table->timestamp('expires_at');
            $table->timestamps();
        });
        Schema::create('cracks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('victim_id');
            $table->tinyInteger('status')->default(0); // 0 = working, 1 = successful, 2 = failed
            $table->timestamp('expires_at');
            $table->tinyInteger('visible')->default(1);
            $table->timestamps();
        });
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('victim_id');
            $table->tinyInteger('status')->default(0); // 0 = working, 1 = successful, 2 = failed
            $table->tinyInteger('type')->default(0); // 0 = download, 1 = upload
            $table->string('app_name');
            $table->bigInteger('app_level')->default(1);
            $table->timestamp('expires_at');
            $table->tinyInteger('visible')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bypasses');
        Schema::dropIfExists('cracks');
        Schema::dropIfExists('transfers');
    }
};
