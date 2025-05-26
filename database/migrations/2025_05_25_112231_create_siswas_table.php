<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nisn')->unique();
            $table->string('nis')->unique();
            $table->string('nama');
            $table->enum('kelas', ['X', 'XI', 'XII']);
            $table->string('alamat');
            $table->string('no_telepon')->nullable();
            $table->enum('jenis_kelamin', ['l', 'p']);
            $table->date('tanggal_lahir')->nullable();
            // Alternative: Use foreignId() to create column and constraint together
            $table->foreignId('agama_id')->constrained('agamas');
            $table->foreignId('jurusan_id')->constrained('jurusans');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};