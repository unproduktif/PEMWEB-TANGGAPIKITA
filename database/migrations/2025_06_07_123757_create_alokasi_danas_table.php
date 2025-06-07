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
        Schema::create('alokasi_danas', function (Blueprint $table) {
            $table->id('id_alokasidana');                
            $table->unsignedBigInteger('id_laporandonasi'); 
            $table->text('keterangan');
            $table->string('tujuan');
            $table->bigInteger('jumlah');
            $table->timestamps();
            $table->foreign('id_laporandonasi')->references('id_laporandonasi')->on('laporan_donasis')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alokasi_danas');
    }
};
