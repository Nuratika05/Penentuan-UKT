<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['sub_kriteria'];

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

    // get subkriteria
    public function subkriteria()
    {
        return $this->hasMany(Subkriteria::class);
    }

    // get subkriteria value from kriteria's id
    public function getSubKriteriaAttribute()
    {
        return $this->subkriteria()->pluck('nilai', 'id')->toArray();
    }
}
