<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Grup_soal extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ??  false, function($query, $search){
            return $query->where('nama_grup', 'like', '%' . $search . '%');
        });

        // $query->when($filters['modul'] ?? false, fn($query, $modul) =>
        //     $query->whereHas('modul', fn($query) =>
        //         $query->where('nama_modul', $modul)
        //     )
        // );
    }
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($grupsoal) {
            $grupsoal->soal()->delete(); // Hapus data soal yang berelasi
        });
    }

    public function modul()
    {
        return $this->belongsTo(modul::class);
    }

    public function soal()
    {
        return $this->hasMany(soal::class);
        return soal::latest()->filter(request(['search']))->paginate(10);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function ujian()
    {
        return $this->belongsTo(Ujian::class);
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_grup'
            ]
        ];
    }
}
