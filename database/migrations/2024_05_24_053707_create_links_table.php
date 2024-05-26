<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinksTable extends Migration
{
    public function up()
    {
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->string('url');  // Pastikan kolom 'url' ada di sini
            $table->date('tanggal_aktif');
            $table->date('tanggal_mati')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('links');
    }
}
