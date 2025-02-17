<?php

use Illuminate\Database\Migrations\Migration; // Mengimpor kelas migration
use Illuminate\Database\Schema\Blueprint; // Mengimpor kelas blueprint
use Illuminate\Support\Facades\Schema; // Mengimpor schema

return new class extends Migration
{
    /**
     * Menjalankan Migrasi.
     */
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id(); // Membuat kolom id sebagai primary key dengan auto-increment
            $table->string('name'); // Membuat kolom name dengan tipe String
            $table->string('description'); // Membuat kolom description dengan tipe String
            $table->timestamps(); // Membuat kolom created_at dan updated_at secara otomatis
        });
    }

    /**
     * Membatalkan Migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('items'); // Menghapus tabel items jika rollback dilakukan
    }
};
