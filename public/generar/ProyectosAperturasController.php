<?php

namespace App\Http\Controllers;

use App\ProyectosAperturas;
use App\Http\Controllers\Controller;
use Validator, Input, Redirect, View, Session, Hash;
#use Illuminate\Http\Request;

class ProyectosAperturas extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        //$this->middleware('log')->only('index');

        //$this->middleware('subscribed')->except('store');
    }
    
     /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $datos = ProyectosAperturas::all();
        return View::make('proyectosaperturas.index')
            ->with(['datos' => $datos, 'title_head' => 'Todos los proyectos aperturas']);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    { 
        
        $datos['id']='';
        $datos['descripcion']='';
        $datos['fecha_inicio']='';
        $datos['fecha_fin']='';
        $datos['inversion']='';
        $datos['gastos']='';
        $datos['proyectos_estatus_id']='';
        $datos['proyectos_definiciones_id']='';

        return View::make('proyectosaperturas.create')
                ->with(['datos' => $datos, 'title_head' => 'Crear proyectos aperturas']);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // validate
        $rules = array(
            
            'id' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'inversion' => 'required',
            'gastos' => 'required',
            'proyectos_estatus_id' => 'required',
            'proyectos_definiciones_id' => 'required',

        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('proyectosaperturas/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $datos = new ProyectosAperturas;
            $datos->id = Input::get('id');
            $datos->descripcion = Input::get('descripcion');
            $datos->fecha_inicio = Input::get('fecha_inicio');
            $datos->fecha_fin = Input::get('fecha_fin');
            $datos->inversion = Input::get('inversion');
            $datos->gastos = Input::get('gastos');
            $datos->proyectos_estatus_id = Input::get('proyectos_estatus_id');
            $datos->proyectos_definiciones_id = Input::get('proyectos_definiciones_id');

            $datos->save();

            // redirect
            Session::flash('message', 'proyectos aperturas creado stisfactoriamente!');
            return Redirect::to('proyectosaperturas');
        }
    }
            
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $datos = ProyectosAperturas::find($id);
        return View::make('proyectosaperturas.show')
            ->with(['datos' => $datos, 'title_head' => 'Ver proyectos aperturas']);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $datos = ProyectosAperturas::find($id);
        return View::make('proyectosaperturas.edit')
            ->with(['datos' => $datos, 'title_head' => 'Editar proyectos aperturas']);
    }
    
    
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
         // validate
        $rules = array(
            'id' => 'required',
            'descripcion' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            'inversion' => 'required',
            'gastos' => 'required',
            'proyectos_estatus_id' => 'required',
            'proyectos_definiciones_id' => 'required',
            
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('proyectosaperturas/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $datos = proyectosaperturas::find($id);
            $datos->id = Input::get('id');
            $datos->descripcion = Input::get('descripcion');
            $datos->fecha_inicio = Input::get('fecha_inicio');
            $datos->fecha_fin = Input::get('fecha_fin');
            $datos->inversion = Input::get('inversion');
            $datos->gastos = Input::get('gastos');
            $datos->proyectos_estatus_id = Input::get('proyectos_estatus_id');
            $datos->proyectos_definiciones_id = Input::get('proyectos_definiciones_id');
            
            $datos->save();

            // redirect
            Session::flash('message', 'proyectos aperturas modificado satisfactoriamente!');
            return Redirect::to('proyectosaperturas');
        }
    }
    
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        // delete
        $datos = ProyectosAperturas::find($id);
        $datos->delete();

        // redirect
        Session::flash('message', 'Usuario eliminado satisfactoriamente!');
        return Redirect::to('proyectosaperturas');
    }
    
}
