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
        Schema::create('berkas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained();
            $table->foreignId('penilaian_id')->nullable()->constrained();
            $table->string('foto_slip_gaji');
            $table->string('foto_tempat_tinggal');
            $table->string('foto_kendaraan');
            $table->string('foto_daya_listrik');
            $table->enum('status', ['Belum Lengkap', 'Menunggu Verifikasi', 'Lulus Verifikasi']);
            $table->text('keterangan')->nullable();
            $table->foreignId('admin_id')->nullable()->constrained();
            $table->foreignId('golongan_id')->nullable()->constrained();
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
        Schema::dropIfExists('berkas');
    }
};
