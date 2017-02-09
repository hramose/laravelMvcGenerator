<?php

namespace App\Http\Controllers\admin;

use App\UsuariosTipos;
use Validator, Input, Redirect, View, Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserTypeController extends Controller
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
        $datos = UsuariosTipos::all();
        return View::make('userType.index')
            ->with(['datos' => $datos, 'title_head' => 'Todos los Tipos']);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $datos['name']=''; 
        $datos['username']=''; 
        $datos['email']=''; 
       
        // load the create form (app/views/user/create.blade.php)
        return View::make('userType.create')
                ->with(['datos' => $datos, 'title_head' => 'Crear Tipo']);
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
            'descripcion' => 'required|max:255',            
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('userType/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $datos = new UsuariosTipos;
            $datos->descripcion       = Input::get('descripcion');           
            $datos->save();

            // redirect
            Session::flash('message', 'Tipo Usuario creado stisfactoriamente!');
            return Redirect::to('userType');
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
        $datos = UsuariosTipos::find($id);
        return View::make('userType.show')
            ->with(['datos' => $datos, 'title_head' => 'Ver Tipo']);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $datos = UsuariosTipos::find($id);
        return View::make('userType.edit')
            ->with(['datos' => $datos, 'title_head' => 'Editar Tipo']);
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
            'descripcion' => 'required|max:255',
            
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('userType/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $datos = UsuariosTipos::find($id);  
            $datos->descripcion       = Input::get('descripcion');         
            $datos->save();

            // redirect
            Session::flash('message', 'Tipo Usuario modificado satisfactoriamente!');
            return Redirect::to('userType');
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
        $datos = UsuariosTipos::find($id);
        $datos->delete();

        // redirect
        Session::flash('message', 'Tipo Usuario eliminado satisfactoriamente!');
        return Redirect::to('userType');
    }
    
}
