<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_kendaraan', function (Blueprint $table) {
            $table->id('id_kendaraan');
            $table->string('plat_nomer');
            $table->string('jenis_kendaraan');
            $table->string('warna_kendaraan')->nullable();
            $table->string('pemilik')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->timestamps();

         $table->foreign('id_user')->references('id_user')->on('tb_users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_kendaraan');
    }
};