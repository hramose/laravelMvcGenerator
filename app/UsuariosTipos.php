<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsuariosTipos extends Model
{
    protected $table = 'usuarios_tipos';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'descripcion',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 
    ];
    
    public $timestamps = false;
}
