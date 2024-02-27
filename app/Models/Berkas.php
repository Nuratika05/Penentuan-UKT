<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function golongan()
    {
        return $this->belongsTo(Golongan::class);
    }

}
