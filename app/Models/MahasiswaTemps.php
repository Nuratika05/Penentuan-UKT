<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MahasiswaTemps extends  Model
{
    use HasFactory;
    protected $table = 'mahasiswa_temps';
    protected $primaryKey = 'code_temps';
    public $incrementing = true;
    public $timestamps = true;

    protected $guarded = [];
    protected $fillable = [

        'id_temps',
        'nama_temps',
        'jenis_kelamin_temps',
        'no_telepon_temps',
        'alamat_temps',
        'prodi_id_temps',
        'password_temps' ,
        'status_upload',
        'check',
        'eror_location',
        'upload_code',
    ];


    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id_temps', 'id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
}

