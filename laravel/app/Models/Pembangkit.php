<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembangkit extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_pembangkit';

    protected $table = 'pembangkits';

    protected $fillable = [
        'nama_pembangkit',
        'jenis_pembangkit',
        'kepemilikan_aset',
        'energi_primer',
        'kapasitas',
        'DMN',
    ];
}
