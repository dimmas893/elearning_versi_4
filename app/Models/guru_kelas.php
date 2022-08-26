<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru_kelas extends Model
{
    use HasFactory;
    protected $table = 'guru_kelas';
    protected $fillable = [
        'guru_id',
        'ruangan_id',
        'mata_pelajaran_id'
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
