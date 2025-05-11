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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('nama_costumer');
            $table->string('no_hp', 15);
            $table->string('nama_produk');
            $table->date('tanggal_pesanan');
            $table->string('jenis_pesanan');
            $table->integer('jumlah')->unsigned();
            $table->integer('total')->unsigned();
            $table->enum('status', ['blm_lunas', 'lunas'])->default('blm_lunas');
            $table->string('bukti_pembayaran')->nullable();

            $table->foreign('nama_produk')->references('nama')->on('products')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
