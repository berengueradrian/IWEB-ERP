<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    use HasFactory;

    protected $fillable = [
        'hora_entrada',
        'hora_salida',
        'fecha',
        'completada',
        'user',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
