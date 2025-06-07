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
        Schema::create('laporan_donasis', function (Blueprint $table) {
            $table->id('id_laporandonasi');              
            $table->unsignedBigInteger('id_donasi');     
            $table->unsignedBigInteger('id_admin');      
            $table->text('deskripsi');
            $table->bigInteger('total');                 
            $table->bigInteger('sisa');                  
            $table->timestamp('tanggal')->useCurrent();
            $table->timestamps();
            $table->foreign('id_donasi')->references('id_donasi')->on('donasis')->onDelete('restrict');
            $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_donasis');
    }
};
