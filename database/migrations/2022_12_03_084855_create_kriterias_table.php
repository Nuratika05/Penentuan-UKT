<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriterias', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama');
            $table->enum('atribut', ['Benefit', 'Cost']);
            $table->string('bobot');
            // $table->foreignId('mahasiswa_id')->constrained();
            // $table->string('penghasilan');
            // $table->string('tempat_tinggal');
            // $table->string('foto_tempat_tinggal');
            // $table->string('kendaraan');
            // $table->string('foto_kendaraan');
            // $table->string('fasilitas_rumah');
            // $table->string('daya_listrik');
            // $table->string('alat_elektronik');
            // $table->string('jumlah_tanggungan');
            // $table->enum('penerima_bantuan', ['Terima', 'Tidak Terima']);
            // $table->enum('status', ['Belum Lengkap', 'Menunggu Verifikasi', 'Lengkap']);
            // $table->foreignId('admin_id')->nullable()->constrained();
            // $table->foreignId('golongan_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kriterias');
    }
};
