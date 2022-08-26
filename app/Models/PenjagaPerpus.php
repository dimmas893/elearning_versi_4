<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjagaPerpus extends Model
{
    use HasFactory;
    protected $table = 'penjaga_perpus';
    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];
}
