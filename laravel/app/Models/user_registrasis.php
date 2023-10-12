<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_registrasis extends Model
{
    use HasFactory;
 
    protected $table = 'user_registrasis';

    protected $fillable = [
        'nama_user',
        'nip',
        'instansi',
        'email',
        'role',
        'password',
    ];
}
