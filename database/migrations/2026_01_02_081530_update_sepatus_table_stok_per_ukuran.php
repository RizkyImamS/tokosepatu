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
        Schema::table('sepatus', function (Blueprint $table) {
            // Menghapus kolom stok dan ukuran yang lama
            $table->dropColumn(['stok', 'ukuran']);

            // Menambahkan kolom baru bertipe JSON
            // json() memungkinkan kita menyimpan data seperti {"39": 10, "40": 5}
            $table->json('stok_per_ukuran')->after('harga')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sepatus', function (Blueprint $table) {
            // Mengembalikan ke struktur awal jika di-rollback
            $table->dropColumn('stok_per_ukuran');
            $table->integer('stok');
            $table->string('ukuran');
        });
    }
};
