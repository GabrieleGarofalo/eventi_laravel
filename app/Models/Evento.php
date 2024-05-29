<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
         'data',
         'descrizione',
         'immagine',

    ];

    public function personas()
    {
        return $this->hasMany(Persona::class, 'evento_id');
    }
}
