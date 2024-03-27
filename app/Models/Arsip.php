<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arsip extends Model
{
    use HasFactory;
    protected $guard = 'arsip';

    protected $guarded = [];
    public function folder(){
        return $this->belongsTo(Folder::class);
    }
}
