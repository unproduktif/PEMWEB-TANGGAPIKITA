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
        Schema::create('edukasis', function (Blueprint $table) {
            $table->id('id_edukasi');
            $table->unsignedBigInteger('id_admin');
            $table->string('judul');
            $table->text('konten');
            $table->string('gambar')->nullable();
            $table->timestamps();
            $table->foreign('id_admin')->references('id_admin')->on('admins')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
