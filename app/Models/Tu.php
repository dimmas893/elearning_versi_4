<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tu extends Model
{
    use HasFactory;
    protected $table = 'tu';
    protected $fillable = [
        'name',
        'email',
        'password',
        'image'
    ];
}
