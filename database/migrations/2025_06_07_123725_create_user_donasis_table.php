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
            $table->string('metode')->nullable();
            $table->bigInteger('jumlah');
            $table->text('pesan')->nullable();
            $table->string('order_id')->unique()->nullable();
            $table->enum('status', ['pending', 'settlement', 'cancel', 'expire', 'failure'])->default('pending');
            $table->string('snap_token')->nullable();
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
