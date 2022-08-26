<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Siswa extends Authenticatable
{

    use HasFactory, Notifiable;
    protected $table = 'siswa';
    protected $fillable = [
        'name',
        'email',
        'alamat',
        'image',
        'nisn',
        'gender',
        'password'
    ];

    public function mahasiswaAbsenHariIni()
    {
        return $this->hasOne(Absen::class)
            ->whereNotNull('siswa_id')
            ->where('parent', '!=', 0)
            ->where('status', 1)
            ->whereDate('created_at', date('Y-m-d'));
    }

    public function isAbsen($jadwalId)
    {
        return $this->absens()->whereNotNull('siswa_id')
        ->where('parent', '!=', 0)
        ->where('status', 1)
        ->where('jadwal_id', $jadwalId)
            ->whereDate('created_at', date('Y-m-d'));
    }

    public function getCreatedAtAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->translatedFormat('l, d F Y');
    }
    public function nilais()
    {
        return $this->hasManyThrough(Nilai::class, Tugas::class);
    }
}
