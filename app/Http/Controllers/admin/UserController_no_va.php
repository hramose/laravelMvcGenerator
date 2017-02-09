<?php

namespace App\Http\Controllers\admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $datos['title_head']='Users';
        
        $datos['datos'] = User::all();
        
        //$datos['css'] = array('animate/css/animate','animate/css/login');
        //$datos['js'] = array('animate/js/animation-person');
        
        return view('admin/users',$datos);
    }
        
    
     /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $datos['title_head']='Users';
        
        
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    
    
    
    
    
    public function form(Request $request) {
        $datos['title_head']='User - nuevo';        
        
        $segment = $request->segment(4);
        if($segment>0){
            $id = intval($segment);
        }else{
            $id = 0;
        }
        
        try {
            $datos['datos'] = User::find($id);
        } catch (Exception $exc) {
            $datos['datos'] = null;
            echo $exc->getTraceAsString();
        }
        
        //$datos['css'] = array('animate/css/animate','animate/css/login');
        //$datos['js'] = array('animate/js/animation-person');
        
        return view('admin/user',$datos);
    }
    
    
    public function record() {
        //Guardar
    }
    
    public function delete($param) {
        $datos['title_head']='User - eliminar';
        
        $datos['datos'] = User::all();
        
        //$datos['css'] = array('animate/css/animate','animate/css/login');
        //$datos['js'] = array('animate/js/animation-person');
        
        return view('admin/user',$datos);
    }
}
