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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('level')->default(1);
            $table->string('ip')->unique('ip');
            $table->integer('oc')->default(0);
            $table->integer('checking_bitcoins')->default(0);
            $table->integer('secured_bitcoins')->default(0);
            $table->longText('log')->default('');
            $table->integer('antivirus_level')->default(1);
            $table->integer('spam_level')->default(1);
            $table->integer('spyware_level')->default(1);
            $table->integer('firewall_level')->default(1);
            $table->integer('bypasser_level')->default(1);
            $table->integer('password_cracker_level')->default(1);
            $table->integer('password_encryptor_level')->default(1);
            $table->unsignedInteger('platform_id')->default(1);
            $table->unsignedInteger('network_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['level', 'platform']);
        });
    }
};
