<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokUKT extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'kelompokukts';

    public function prodi(){
        return $this->belongsTo(Prodi::class, 'prodi_id');
    }
}
