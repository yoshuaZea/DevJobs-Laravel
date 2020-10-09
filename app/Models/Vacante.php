<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vacante extends Model{
    protected $fillable = [
        'titulo',
        'imagen',
        'descripcion',
        'skills',
        'categoria_id',
        'experiencia_id',
        'ubicacion_id',
        'salario_id',
        'user_id',
    ];

    // RELACIONES
    public function usuario(){
        return $this->belongsTo('App\User', 'user_id');
    }

    // Relación 1:1
    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function salario(){
        return $this->belongsTo(Salario::class, 'salario_id');
    }

    public function ubicacion(){
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }

    public function experiencia(){
        return $this->belongsTo(Experiencia::class, 'experiencia_id');
    }

    // Relación 1:n vacante y candidatos
    public function candidatos(){
        return $this->hasMany('App\Models\Candidato', 'vacante_id');
    }
}
