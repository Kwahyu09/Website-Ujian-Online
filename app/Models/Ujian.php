<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Ujian extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ??  false, function($query, $search){
            return $query->where('kd_ujian', 'like', '%' . $search . '%')
                  ->orWhere('nama_ujian', 'like', '%' . $search . '%')
                  ->orWhere('kelas', 'like', '%' . $search . '%')
                  ->orWhere('modul', 'like', '%' . $search . '%')
                  ->orWhere('grupsoal', 'like', '%' . $search . '%')
                  ->orWhere('tanggal', 'like', '%' . $search . '%')
                  ->orWhere('waktu_mulai', 'like', '%' . $search . '%')
                  ->orWhere('waktu_selesai', 'like', '%' . $search . '%');
        });
    }


    public function modul()
    {
        return $this->belongsTo(modul::class);
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function grup_soal()
    {
        return $this->hasOne(Grup_soal::class);
    }

    public function evaluasi()
    {
        return $this->hasOne(evaluasi::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_modul'
            ]
        ];
    }
}

