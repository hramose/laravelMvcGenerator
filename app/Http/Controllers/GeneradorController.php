<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session, DB, Auth;


class GeneradorController extends Controller
{
    
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['nombre_bd'] = '';
        $datos['nombre_tabla'] = '';
        return view('generador/tablas')->with($datos);
    }
    
    public function find_table(Request $request) {
        
        
        if($request->isMethod('post')){
            
            $this->validate($request,[
                'nombre_bd'=>'required',
                'nombre_tabla'=>'required',
            ]);                        
            
            $nombre_bd = $request->input("nombre_bd");
            $nombre_tabla = $request->input("nombre_tabla");
            
            
            $query = "SELECT COLUMN_NAME "
                . "FROM INFORMATION_SCHEMA.COLUMNS "
                . "WHERE table_schema = '".$nombre_bd."'"
                . "AND table_name = '".$nombre_tabla."' "; 
            
            $res = DB::select($query);
            /*
             * devuelve la consulta:
                ->toSql();
             */
            //var_dump($res);            
            //dd($res);            
            
            return view('generador.columnas', 
                    ['columnas' => $res,
                    'nombre_bd' => $nombre_bd,
                    'nombre_tabla' => $nombre_tabla,    
                    ]);
        }
        
    }
    
    public function generar_archivo(Request $request) {
        
        $nombre_bd = $request->input("nombre_bd");
        $nombre_tabla = $request->input("nombre_tabla");        
        $campos=$request->input("titulos");  
        $tipo=$request->input("tipo");    
        
        if(in_array('0', $tipo, true)){
            $this->generarModelo($nombre_tabla, $campos, $nombre_bd);
        }

        if(in_array('1', $tipo, true)){
            $this->generarControlador($nombre_tabla, $campos, $nombre_bd); 
        }
            
        if(in_array('2', $tipo, true)){
            $this->generarIndex($nombre_tabla, $campos, $nombre_bd);
            $this->generarCreate($nombre_tabla, $campos, $nombre_bd);
            $this->generarEdit($nombre_tabla, $campos, $nombre_bd);
            $this->generarShow($nombre_tabla, $campos, $nombre_bd);
        }
        
        // redirect
        Session::flash('message', 'La base de datos: '.$nombre_bd.' '.$nombre_tabla.
                ' fué creado satisfactoriamente!');
        
        $datos['nombre_bd'] = $nombre_bd;
        $datos['nombre_tabla'] = $nombre_tabla;
        
        //return view('generador/tablas')->with($datos);
        return redirect('generador');
    }
    
        
    /***********************************
    ************************************
     *          MODELO     
    ************************************
     *      */    
    function generarModelo($nombre_tabla, $campos, $nombre_bd) {        
        /* ucwords  * strtolower */
        
        $pal1 = str_replace("_", ' ', $nombre_tabla); 
        $pal2 = ucwords(strtolower($pal1));
        $nombre_forma = trim(str_replace(' ', '', $pal2));
        
        $file = fopen("generar/".$nombre_forma.".php", "w") or die("Error al Crear el archivo");
        
                
        $cuerpo = '<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class '.$nombre_forma.' extends Model
{
    protected $table = \''.strtolower($nombre_tabla).'\';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [';
        fwrite($file, $cuerpo . PHP_EOL);    
        $input='        ';
        foreach($campos as $val){  
            $input .= '\''.$val.'\', ';           
                        
        }   
        fwrite($file, $input . PHP_EOL);
        $cuerpo = '    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
    
    public $timestamps = false;
}';    
        fwrite($file, $cuerpo . PHP_EOL);

        //FIN...
        fclose($file);
        
    }
    
     /***********************************
    ************************************
     *          CONTROLADOR    
    ************************************
     *      */       
    public function generarControlador($nombre_tabla, $campos, $nombre_bd) {
        
        $pal1 = str_replace("_", ' ', $nombre_tabla); 
        $pal2 = ucwords(strtolower($pal1));
        $nombre_forma = trim(str_replace(' ', '', $pal2));
        
        
        $file = fopen("generar/".$nombre_forma."Controller.php", "w") or die("Error al Crear el archivo");
        
                 
        $cuerpo = '<?php

namespace App\Http\Controllers;

use App\\'.$nombre_forma.';
use App\Http\Controllers\Controller;
use Validator, Input, Redirect, View, Session;
#use Illuminate\Http\Request;

class '.$nombre_forma.'Controller extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(\'auth\');

        //$this->middleware(\'log\')->only(\'index\');

        //$this->middleware(\'subscribed\')->except(\'store\');
    }
    
     /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $datos = '.$nombre_forma.'::all();
        return View::make(\''.strtolower($nombre_forma).'.index\')
            ->with([\'datos\' => $datos, \'title_head\' => \'Todos los '.$pal1.'\']);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    { 
        ';
        fwrite($file, $cuerpo . PHP_EOL); 
        
        foreach($campos as $val){  
            $input = '        '.'$datos[\''.$val.'\']=\'\';';           
            fwrite($file, $input . PHP_EOL);            
        }        
        $cuerpo = '
        return View::make(\''.strtolower($nombre_forma).'.create\')
                ->with([\'datos\' => $datos, \'title_head\' => \'Crear '.$pal1.'\']);
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
            ';
            fwrite($file, $cuerpo . PHP_EOL);
            
            foreach($campos as $val){  
                $input = '            '.'\''.$val.'\' => \'required\',';           
                fwrite($file, $input . PHP_EOL);            
            } 
            $cuerpo = '
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(\''.strtolower($nombre_forma).'/create\')
                ->withErrors($validator)
                ->withInput(Input::except(\'password\'));
        } else {
            // store
            $datos = new '.$nombre_forma.';';
            fwrite($file, $cuerpo . PHP_EOL);
            
            foreach($campos as $val){  
                $input = '            '.'$datos->'.$val.' = Input::get(\''.$val.'\');';           
                fwrite($file, $input . PHP_EOL);            
            } 
        $cuerpo = '
            $datos->save();

            // redirect
            Session::flash(\'message\', \''.$pal1.' creado satisfactoriamente!\');
            return Redirect::to(\''.strtolower($nombre_forma).'\');
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
        $datos = '.$nombre_forma.'::find($id);
        return View::make(\''.strtolower($nombre_forma).'.show\')
            ->with([\'datos\' => $datos, \'title_head\' => \'Ver '.$pal1.'\']);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $datos = '.$nombre_forma.'::find($id);
        return View::make(\''.strtolower($nombre_forma).'.edit\')
            ->with([\'datos\' => $datos, \'title_head\' => \'Editar '.$pal1.'\']);
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
        $rules = array(';
        fwrite($file, $cuerpo . PHP_EOL);
        foreach($campos as $val){  
                $input = '            '.'\''.$val.'\' => \'required\',';           
                fwrite($file, $input . PHP_EOL);            
            } 
        $cuerpo = '            
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to(\''.strtolower($nombre_forma).'/\' . $id . \'/edit\')
                ->withErrors($validator)
                ->withInput(Input::except(\'password\'));
        } else {
            $datos = '.strtolower($nombre_forma).'::find($id);'; 
            fwrite($file, $cuerpo . PHP_EOL);
            
            foreach($campos as $val){  
                $input = '            '.'$datos->'.$val.' = Input::get(\''.$val.'\');';           
                fwrite($file, $input . PHP_EOL);            
            } 
        $cuerpo = '            
            $datos->save();

            // redirect
            Session::flash(\'message\', \''.$pal1.' modificado satisfactoriamente!\');
            return Redirect::to(\''.strtolower($nombre_forma).'\');
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
        $datos = '.$nombre_forma.'::find($id);
        $datos->delete();

        // redirect
        Session::flash(\'message\', \'Usuario eliminado satisfactoriamente!\');
        return Redirect::to(\''.strtolower($nombre_forma).'\');
    }
    
}';
        fwrite($file, $cuerpo . PHP_EOL); 
        
        //FIN...
        fclose($file);
    }
    
    
     /***********************************
    ************************************
     *          VISTA  CRUD
    ************************************
     * */   
    
    //GENERAR 4 ARCHIVOS
    
    public function generarIndex($nombre_tabla, $campos, $nombre_bd) {
        
        $pal1 = str_replace("_", ' ', $nombre_tabla); 
        $pal2 = ucwords(strtolower($pal1));
        $nombre_forma = trim(str_replace(' ', '', $pal2));
        
        $file = fopen("generar/index.blade.php", "w") or die("Error al Crear el archivo");
        
        $cuerpo = '@extends(\'layouts.app\')

@section(\'content\')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>{{ $title_head }}</h1>
        </div> 
        <div class="col-md-12">
            <a href="{{ URL::to(\''.strtolower($nombre_forma).'/create\') }}" class="btn btn-success">Agregar</a>
        </div>
    </div>
    
    <div class="row">         
        <?php
        if ($datos) {
            ?>                          
            <table class="table table-responsive" id="mi_tabla">
                <thead>
                    <tr>
                        <th>#</th>';
            fwrite($file, $cuerpo . PHP_EOL);
            
            foreach($campos as $val){  
                $input = '                            '.'<th>'.$val.'</th>';           
                fwrite($file, $input . PHP_EOL);            
            } 
            $cuerpo = '
                        <th>ACCION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($datos as $row) {
                        ?>
                        <tr>
                            <td><?= $i ?></td>';
            fwrite($file, $cuerpo . PHP_EOL);
            
            foreach($campos as $val){  
                $input = '                            '.'<td><?= $row->'.$val.'?></td>';           
                fwrite($file, $input . PHP_EOL);            
            } 
            $cuerpo = '
                            <td>
                                <a href="{{ URL::to(\''.strtolower($nombre_forma).'\') }}<?= \'/\' . $row->id ?>" title="ver registro" class="btn btn-info">Ver</a>
                                <a href="{{ URL::to(\''.strtolower($nombre_forma).'\')}}<?= \'/\' . $row->id . \'/edit\' ?>" title="editar registro" class="btn btn-warning">Editar</a>

                                {{ Form::open(array(\'url\' => \''.strtolower($nombre_forma).'/\' . $row->id, \'class\' => \'pull-right\')) }}
                                {{ Form::hidden(\'_method\', \'DELETE\') }}
                                {{ Form::submit(\'Eliminar\', 
                                                            array(\'class\' => \'btn btn-danger\',
                                                                \'title\'=>\'eliminar registro\',
                                                                \'onclick\'=>\'return confirm("Eliminar este Registro?")\')) 
                                }}
                                {{ Form::close() }}

                            </td>

                        </tr>                      
                        <?php
                        $i++;
                    }
                    ?>        
                </tbody>                        
            </table> 
        <?php } ?>
    </div>
</div>
</div>
@endsection
';
        fwrite($file, $cuerpo . PHP_EOL);           
                
        
        
    }
    
    public function generarCreate($nombre_tabla, $campos, $nombre_bd) {
        
        $pal1 = str_replace("_", ' ', $nombre_tabla); 
        $pal2 = ucwords(strtolower($pal1));
        $nombre_forma = trim(str_replace(' ', '', $pal2));
        
        $file = fopen("generar/create.blade.php", "w") or die("Error al Crear el archivo");
        
        $cuerpo = '@extends(\'layouts.app\')

@section(\'content\')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>{{ $title_head }}</h1>
        </div> 
        <div class="col-md-12">
            <a href="{{ URL::to(\''.strtolower($nombre_forma).'\') }}" class="btn btn-success">Ver Todos</a>
        </div>
    </div>
</div>

<!-- if there are creation errors, they will show here -->
@if (count($errors) > 0)
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    </div>

</div>        
@endif

<div class="container"> 
    <div class="row">
        <form class="form-horizontal" role="form" method="POST" action="{{ url(\''.strtolower($nombre_forma).'\') }}">
            {{ csrf_field() }}       
            ';
            fwrite($file, $cuerpo . PHP_EOL);
            
            foreach($campos as $val){  
                $input = '
                <div class="form-group{{ $errors->has(\''.$val.'\') ? \' has-error\' : \'\' }}">
                <label for="'.$val.'" class="col-md-4 control-label">'.$val.'</label>

                <div class="col-md-6">
                    <input id="'.$val.'" type="text" class="form-control" name="'.$val.'" value="{{ old(\''.$val.'\') }}" autofocus>

                    @if ($errors->has(\''.$val.'\'))
                    <span class="help-block">
                        <strong>{{ $errors->first(\''.$val.'\') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            ';           
                fwrite($file, $input . PHP_EOL);            
            } 
            
            $cuerpo = '
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Registrar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection';
        fwrite($file, $cuerpo . PHP_EOL);   
        
        
        
    }
    
    public function generarEdit($nombre_tabla, $campos, $nombre_bd) {
        
        $pal1 = str_replace("_", ' ', $nombre_tabla); 
        $pal2 = ucwords(strtolower($pal1));
        $nombre_forma = trim(str_replace(' ', '', $pal2));
        
        $file = fopen("generar/edit.blade.php", "w") or die("Error al Crear el archivo");
        $cuerpo = '@extends(\'layouts.app\')

@section(\'content\')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>{{ $title_head }}</h1>
        </div> 
        <div class="col-md-12">
            <a href="{{ URL::to(\''.strtolower($nombre_forma).'\') }}" class="btn btn-success">Ver Todos</a>
            <a href="{{ URL::to(\''.strtolower($nombre_forma).'/create\') }}" class="btn btn-success">Agregar</a>
        </div>
    </div>
</div>


<div class="container"> 
    <div class="row">        
        {{ Form::model($datos, 
                    array(\'route\' => array(\''.strtolower($nombre_forma).'.update\', $datos->id), 
                    \'method\' => \'PUT\', 
                    \'class\'=>\'form-horizontal\', 
                    \'role\'=>\'form\')) }}      
            ';
            fwrite($file, $cuerpo . PHP_EOL);
            
            foreach($campos as $val){  
                $input = '
                <div class="form-group{{ $errors->has(\''.$val.'\') ? \' has-error\' : \'\' }}">
                <label for="'.$val.'" class="col-md-4 control-label">'.$val.'</label>

                <div class="col-md-6">
                    <input id="'.$val.'" type="text" class="form-control" name="'.$val.'" value="{{ $datos->'.$val.' }}" autofocus>

                    @if ($errors->has(\''.$val.'\'))
                    <span class="help-block">
                        <strong>{{ $errors->first(\''.$val.'\') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            ';           
                fwrite($file, $input . PHP_EOL);            
            } 
            
            $cuerpo = '            
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Guardar
                    </button>
                </div>
            </div>
        {{ Form::close() }}
    </div>
</div>
@endsection
';
        fwrite($file, $cuerpo . PHP_EOL);   
         
        
    }
    
    public function generarShow($nombre_tabla, $campos, $nombre_bd) {
        
        $pal1 = str_replace("_", ' ', $nombre_tabla); 
        $pal2 = ucwords(strtolower($pal1));
        $nombre_forma = trim(str_replace(' ', '', $pal2));
        
        $file = fopen("generar/show.blade.php", "w") or die("Error al Crear el archivo");
        $cuerpo = '@extends(\'layouts.app\')

@section(\'content\')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>{{ $title_head }}</h1>
        </div> 
        <div class="col-md-12">
            <a href="{{ URL::to(\''.strtolower($nombre_forma).'\') }}" class="btn btn-success">Ver Todos</a>
            <a href="{{ URL::to(\''.strtolower($nombre_forma).'/create\') }}" class="btn btn-success">Agregar</a>
        </div>
    </div>

    <div class="row">         
        <h1>Mostrando</h1>
        <div class="jumbotron text-center">
            <h2>Registro</h2>
            <p>
            ';
            fwrite($file, $cuerpo . PHP_EOL);
            
            foreach($campos as $val){  
                $input = '            
                <strong>'.$val.':</strong> {{ $datos->'.$val.' }}<br> 
                    ';           
                fwrite($file, $input . PHP_EOL);            
            } 
            
            $cuerpo = '</p>
            
        </div>
    </div>
</div>
</div>
@endsection
';
        fwrite($file, $cuerpo . PHP_EOL);
        
    }
    
    
    
    
}
