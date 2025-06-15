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
        Schema::create('user_donasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_donasi');
            $table->unsignedBigInteger('id_user');
            $table->enum('metode',['transfer', 'qris', 'e-wallet', 'lainnya']);
            $table->bigInteger('jumlah');
            $table->string('bukti')->nullable();
            $table->text('pesan')->nullable();
            $table->timestamps();
            $table->foreign('id_donasi')->references('id_donasi')->on('donasis')->onDelete('restrict');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_donasis');
    }
};
