<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangan';
    protected $fillable = [
        'name',
        'siswa_id',
        'jurusan_id',
        'kelas_id'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }



    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
