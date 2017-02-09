<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProyectosAperturas extends Model
{
    protected $table = 'proyectos_aperturas';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descripcion', 'fecha_inicio', 'fecha_fin', 'inversion', 'gastos', 'proyectos_estatus_id', 'proyectos_definiciones_id', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
    
    public $timestamps = false;
}
