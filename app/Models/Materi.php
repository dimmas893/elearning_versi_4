<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materi';
    protected $fillable = [
        'ruangan_id',
        'guru_id',
        'mata_pelajaran_id',
        'judul',
        'tipe',
        'file_or_link',
        'pertemuan',
        'description',
    ];


    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }


    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }


    public function mata_pelajaran()
    {
        return $this->belongsTo(MataPelajaran::class);
    }
}
