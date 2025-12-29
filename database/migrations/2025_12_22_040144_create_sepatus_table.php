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
        Schema::create('sepatus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_sepatu_id')->constrained('kategori_sepatus')->onDelete('cascade');
            $table->string('nama_sepatu');
            $table->string('merk');
            $table->decimal('harga', 10, 2);
            $table->integer('stok');
            $table->string('ukuran');
            $table->string('warna');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sepatus');
    }
};
