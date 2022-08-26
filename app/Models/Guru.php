<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;

class Guru extends Authenticatable
{

    use HasFactory, Notifiable;
    protected $table = 'guru';
    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function absen()
    {
        return $this->hasMany(Absen::class);
    }
}
