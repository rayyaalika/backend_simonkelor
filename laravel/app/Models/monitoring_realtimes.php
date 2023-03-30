<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class monitoring_realtimes extends Model
{

    protected $fillable = [
        'parameter',
        'value',
        'date',
    ];
}
