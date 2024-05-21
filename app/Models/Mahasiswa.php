<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use App\Observers\MahasiswaObserver;

class Mahasiswa extends Authenticatable
{
    use HasFactory;
    protected $guard = 'mahasiswa';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';


    protected $fillable = [
        'id',
        'nama',
        'jenis_kelamin',
        'no_telepon',
        'alamat',
        'prodi_id',
        'password' ,
        'jalur',
    ];
    public static function rules($id = null)
    {
        return [
            'id' => [
                'required',
                Rule::unique('mahasiswas', 'id')->ignore($id),
            ],
            'password' => [
                'nullable', // password bisa kosong pada saat update
                'required_if:password,' . null, // required hanya jika password tidak kosong
                'min:8',
                'regex:/^\d+$/', // angka saja
            ],
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'prodi_id' => 'required',
            'jalur' => 'required',
        ];
    }

    public static $messages = [
        'id.required' => 'Nomor Pendaftaran harus diisi.',
        'id.unique' => 'Nomor Pendaftaran sudah digunakan.',
        'password.required_if' => 'Password harus diisi jika Anda mengubah password.',
        'password.min' => 'Password harus berisi 8 angka.',
        'password.regex' => 'Password harus berisi hanya angka.',
        'nama.required' => 'Nama harus diisi.',
        'jenis_kelamin.required' => 'Jenis Kelamin harus diisi.',
        'no_telepon.required' => 'Nomor Telepon harus diisi.',
        'alamat.required' => 'Alamat harus diisi.',
        'prodi_id.required' => 'Prodi harus diisi.',
        'jalur.required' => 'Jalur harus diisi',

    ];

    protected $guarded = [];

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }

    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }
    protected static function boot()
    {
        parent::boot();
        self::observe(MahasiswaObserver::class);
    }
}
