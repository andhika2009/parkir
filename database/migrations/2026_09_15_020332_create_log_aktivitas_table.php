<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('log_aktivitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('aktivitas');
            $table->string('ip_address')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id_user')->on('tb_users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_aktivitas');
    }
};