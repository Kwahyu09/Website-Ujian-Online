<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    public function dosen()
    {
        return $this->hasMany(Dosen::class);
    }
    
    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
}
