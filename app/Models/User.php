<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\Modul;
use App\Models\Grup_soal;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guarded = ['id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ??  false, function($query, $search){
            return $query->where('username', 'like', '%' . $search . '%')
                ->orWhere('nama', 'like', '%' . $search . '%')
                ->orWhere('nik', 'like', '%' . $search . '%')
                ->orWhere('nip', 'like', '%' . $search . '%')
                ->orWhere('npm', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        });
    }
    
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            $user->ujian()->delete(); // Hapus data ujian yang berelasi
            $user->modul()->delete(); // Hapus data modul yang berelasi
            $user->grup_soal()->delete(); // Hapus data grupSOAL yang berelasi
        });
    }
    
    public function modul()
    {
        return $this->hasMany(Modul::class);
    }

    public function grup_soal()
    {
        return $this->hasMany(Grup_soal::class);
    }

    public function ujian()
    {
        return $this->hasMany(Ujian::class);
    }
    
    public function hasilujian()
    {
        return $this->hasMany(HasilUjian::class);
    }
    
    public function evaluasi()
    {
        return $this->hasMany(Evaluasi::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
