<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
#use Illuminate\Support\Facades\DB;

class FrontEndController extends Controller
{
    
    private $usuario = '';
    private $pass = '';
    /*
     * VARIABLES CON MSJ: 
     * alert alert-info| alert alert-success |  alert alert-danger*/
    private $msj = NULL;
    private $error = NULL;
    
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');

        //$this->middleware('log')->only('index');

        //$this->middleware('subscribed')->except('store');
    }
    
    public function index() {
        $datos['title_head']='Sign In';       
        $datos['id']=0;        
        $datos['usuario'] = $this->usuario; 
        $datos['pass'] = $this->pass;
                        
        
        $datos['css'] = array('animate/css/animate','animate/css/login');
        //$datos['js'] = array('animate/js/animation-person');
        
        return view('signin', $datos);
    }
    
    public function autentication(Request $request) {
                
        if($request->isMethod('post')){
            
            $this->validate($request,[
                'usuario'=>'required|string',
                'pass'=>'required|string',
            ]);

            dd($request->all());
            
            
            echo "Estoy recibiendo por post";
            echo $usuario = $request->input("usuario");
            echo $pass = $request->input("pass");
            
            //redirect($to);
        }
        
        //dd($request);
        //die();        
        return view('signin');
    }
    
    public function forgotPassword() {
        $datos['title_head']='Forgot Password';
        return view('forgotpassword', $datos);
    }
    
    public function signUp() {
        $datos['title_head']='Sign Up';          
        $datos['id']=0;        
        $datos['nombre'] = ''; 
        $datos['acronimo'] = '';
        $datos['email'] = '';
        $datos['clave'] = '';
        $datos['reclave'] = '';
        
        $datos['css'] = array('animate/css/animate','animate/css/anim-signup');
        //$datos['js'] = array('animate/js/animation-person');
        
        //return view('user.profile', ['user' => User::findOrFail($id)]);
        return view('signup', $datos);
    }
    
    public function register(Request $request) {
        
    }
    
    
}
