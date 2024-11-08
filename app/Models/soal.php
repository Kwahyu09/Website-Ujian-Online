<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class soal extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ??  false, function($query, $search){
            return $query->where('kode_soal', 'like', '%' . $search . '%')
                  ->orWhere('pertanyaan', 'like', '%' . $search . '%')
                  ->orWhere('opsi_a', 'like', '%' . $search . '%')
                  ->orWhere('opsi_b', 'like', '%' . $search . '%')
                  ->orWhere('opsi_c', 'like', '%' . $search . '%')
                  ->orWhere('opsi_d', 'like', '%' . $search . '%')
                  ->orWhere('jawaban', 'like', '%' . $search . '%')
                  ->orWhere('bobot', 'like', '%' . $search . '%');
        });
    }

    public function grup_soal()
    {
        return $this->belongsTo(grup_soal::class);
    }

    public function evaluasi()
    {
        return $this->hasOne(evaluasi::class);
    }
}
