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
        Schema::create('laporans', function (Blueprint $table) {
            $table->id('id_laporan');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_admin')->nullable();
            $table->string('judul');
            $table->text('deskripsi');
            $table->enum('keterangan', ['Banjir', 'Gempa', 'Kebakaran', 'Tanah Longsor', 'Lainnya']);
            $table->string('lokasi');
            $table->string('media');
            $table->enum('status', ['pendding', 'verifikasi'])->default('pendding');
            $table->timestamp('tgl_publish')->nullable();
            $table->timestamps();
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('restrict');
            $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};
