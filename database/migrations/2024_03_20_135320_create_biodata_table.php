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
        Schema::create('biodata', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('email', 50)->nullable();
            $table->enum('jekel', ['Laki-Laki', 'Perempuan']);
            $table->string('kecamatan');
            $table->string('desa');
            $table->string('kota');
            $table->string('tempat_lahir', 30)->nullable();
            $table->date('tgl_lahir');
            $table->string('password');
            $table->enum('role', ['Pemohon', 'Admin Master', 'Admin Desa'])->default('Pemohon');
            $table->string('agama', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon', 13)->nullable();
            $table->string('idpekerjaan', 20)->nullable();
            $table->string('status_warga', 30)->nullable();
            $table->string('warganegara', 10)->nullable();
            $table->string('status_nikah', 20)->nullable();
            $table->string('rt', 10)->nullable();
            $table->string('rw', 10)->nullable();
            $table->string('kodepos', 20)->nullable();
            $table->string('website', 50)->nullable();
            $table->string('foto_ktp')->nullable();
            $table->string('foto_kk')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('biodata');
    }
};
