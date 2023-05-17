<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuncionSustantiva extends Model
{
    use HasFactory;
    protected $table = 'funcion_sustantiva';

    public function tipofuncion()
    {
        return $this->hasOne(TipoFuncion::class, 'id', 'tipo_funcion_id');
    }

    public function estado()
    {
        return $this->hasOne(Estado::class, 'id', 'estado_id');
    }

    public function evidencia()
    {
        return $this->hasMany(Evidencia::class, 'funcion_sustantiva_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id', 'id');
    }
}
