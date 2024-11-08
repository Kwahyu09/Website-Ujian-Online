<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Dosen extends Model
{
    use HasFactory;
    use Sluggable;
    
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ??  false, function($query, $search){
            return $query->where('nip', 'like', '%' . $search . '%')
                  ->orWhere('nama_dos', 'like', '%' . $search . '%')
                  ->orWhere('jabatan', 'like', '%' . $search . '%')
                  ->orWhere('gol_regu', 'like', '%' . $search . '%')
                  ->orWhere('jenis_kel', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_dos'
            ]
        ];
    }
}
