<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    protected $table = 'jadwals';
    protected $fillable = [
        'ruangan_id',
        'guru_id',
        'mata_pelajaran_id',
        'hari',
        'jam_masuk',
        'jam_keluar',
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }

    public function mata_pelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }
    public function hari()
    {
        return $this->belongsTo(Hari::class);
    }
}
