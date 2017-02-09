<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Validator, Input, Redirect, View, Session, Hash;
#use Illuminate\Http\Request;

class UserController extends Controller
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
        $datos = User::all();
        return View::make('user.index')
            ->with(['datos' => $datos, 'title_head' => 'Todos los Usuarios']);
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
        return View::make('user.create')
                ->with(['datos' => $datos, 'title_head' => 'Crear Usuario']);
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
            'name' => 'required|max:255',
            'username' => 'required|max:255|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('user/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $datos = new User;
            $datos->name       = Input::get('name');
            $datos->email      = Input::get('email');
            $datos->username = Input::get('username');
            $datos->password = bcrypt(Input::get('password'));
            $datos->activo = 1;
            $datos->confirmar_email = 1;
            $datos->usuarios_tipos_id = 3;            
            $datos->save();

            // redirect
            Session::flash('message', 'Usuario creado stisfactoriamente!');
            return Redirect::to('user');
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
        $datos = User::find($id);
        return View::make('user.show')
            ->with(['datos' => $datos, 'title_head' => 'Ver Usuario']);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $datos = User::find($id);
        return View::make('user.edit')
            ->with(['datos' => $datos, 'title_head' => 'Editar Usuario']);
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
            'name' => 'required|max:255',
            'username' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'confirmed',
            
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('user/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $datos = User::find($id);            
            $pass = Input::get('password');                        
            if (!Hash::check($pass, $datos->password) && !empty($pass))
            {
                //CAMBIA LA CLAVE
                $datos->password = bcrypt(Input::get('password'));
            }                        
            $datos->name       = Input::get('name');
            $datos->email      = Input::get('email');
            $datos->username = Input::get('username');            
            //$user->activo = 1;
            //$user->confirmar_email = 1;
            $datos->usuarios_tipos_id = 3;            
            $datos->save();

            // redirect
            Session::flash('message', 'Usuario modificado satisfactoriamente!');
            return Redirect::to('user');
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
        $datos = User::find($id);
        $datos->delete();

        // redirect
        Session::flash('message', 'Usuario eliminado satisfactoriamente!');
        return Redirect::to('user');
    }
    
}
