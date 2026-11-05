<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_transaksi', function (Blueprint $table) {
            $table->id('id_transaksi');
            $table->unsignedBigInteger('id_kendaraan')->nullable();
            $table->unsignedBigInteger('id_tarif')->nullable();
            $table->unsignedBigInteger('id_area')->nullable();
            $table->unsignedBigInteger('id_user')->nullable();
            $table->dateTime('waktu_masuk')->nullable();
            $table->dateTime('waktu_keluar')->nullable();
            $table->integer('durasi_jam')->nullable();
            $table->integer('biaya_total')->nullable();
            $table->string('status')->default('masuk');
            $table->timestamps();

            $table->foreign('id_kendaraan')->references('id_kendaraan')->on('tb_kendaraan')->nullOnDelete();
            $table->foreign('id_tarif')->references('id_tarif')->on('tb_tarif')->nullOnDelete();
            $table->foreign('id_area')->references('id_area')->on('tb_area_parkir')->nullOnDelete();
            $table->foreign('id_user')->references('id_user')->on('tb_users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_transaksi');
    }
};