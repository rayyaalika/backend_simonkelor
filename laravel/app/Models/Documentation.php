<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    use HasFactory;

    protected $table = 'documentations'; 

    protected $fillable = [
        'nama_documentation',
        'format_documentation',
        'jenis_documentation',
        'jenis_waktu_documentation',
        'date',
        'path_documentations',
    ];
}
