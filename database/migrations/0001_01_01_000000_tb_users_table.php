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
Schema::create('tb_users', function (Blueprint $table) {
    $table->id('id_user');
    $table->string('nama_lengkap')->nullable();
    $table->string('user_name')->unique();
    $table->string('email')->nullable();
    $table->string('password');
    $table->string('role')->default('petugas');
    $table->boolean('status_aktif')->default(true);
    $table->rememberToken();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::dropIfExists('tb_users');
    }
};