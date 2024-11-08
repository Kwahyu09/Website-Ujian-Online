<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilUjian extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }
    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
