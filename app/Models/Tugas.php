<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $table = 'tugas';
    protected $fillable = [
        'jadwal_id',
        'guru_id',
        'mata_pelajaran_id',
        'siswa_id',
        'parent',
        'judul',
        'type',
        'file_or_link',
        'pertemuan',
        'description',
        'pengumpulan'
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function mata_pelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
