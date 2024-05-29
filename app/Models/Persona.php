<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'cognome', 'evento_id'];

    public function evento()
    {
        return $this->belongsTo(Evento::class, 'evento_id');
    }
}
