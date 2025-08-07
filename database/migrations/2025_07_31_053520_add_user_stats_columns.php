<?php

use App\Enums\MaxSavings;
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
            $table->bigInteger('level')->default(1);
            $table->string('ip')->unique('ip');
            $table->bigInteger('oc')->default(0);
            $table->bigInteger('checking_bitcoins')->default(1500);
            $table->bigInteger('secured_bitcoins')->default(0);
            $table->longText('log')->default('');
            $table->integer('antivirus_level')->default(1);
            $table->integer('spam_level')->default(1);
            $table->integer('spyware_level')->default(1);
            $table->integer('firewall_level')->default(1);
            $table->integer('bypasser_level')->default(1);
            $table->integer('password_cracker_level')->default(1);
            $table->integer('password_encryptor_level')->default(1);
            $table->integer('notepad_level')->default(1);
            $table->unsignedInteger('platform_id')->default(1);
            $table->unsignedInteger('network_id')->default(1);
            $table->bigInteger('max_savings')->default(MaxSavings::MAX_SAVINGS[1]);
            $table->bigInteger('reputation')->default(0);
            $table->bigInteger('score')->default(0);
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
