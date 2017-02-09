@extends('layouts.app')

@section('content')
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
    <div class="rows">
        <div class="panel panel-warning">
            <div class="panel-heading">
                TABLAS                
            </div>
            <div class="panel-body">
                <div>
                    COLUMNAS DE LA TABLA: <?= $nombre_tabla?>
                </div>
                
                <form class="form-horizontal" role="form" method="POST" action="{{ url('generador/generar_archivo') }}">
                    {{ csrf_field() }}       
                <input type="hidden" name="nombre_bd" id="nombre_bd" value="<?= $nombre_bd?>">
                <input type="hidden" name="nombre_tabla" id="nombre_tabla" value="<?= $nombre_tabla?>">
                <div class="checkbox">
                    GENERAR: 
                    <label>
                        <input type="checkbox" name="tipo[]" value="0" id="modelo" checked>Modelo | 
                    </label>                     
                    <label>
                        <input type="checkbox" name="tipo[]" value="1" id="controlador" checked>Controlador |
                    </label>
                    <label>
                        <input type="checkbox" name="tipo[]" value="2" id="vistac" checked>Vista (CRUD) |
                    </label>
                </div>
                
                <?php                
                foreach($columnas as $in => $val){
                    foreach ($val as $v){
                        ?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="titulos[<?php echo trim($v); ?>]" 
                                       value="<?php echo trim($v); ?>" id="<?php echo "ti_".$in; ?>" 
                                       checked><?php echo trim($v); ?>
                            </label>
                        <!--<select name="tipo[]" id="<?php //echo "tp_".$in; ?>">
                            <option value="i">input</option>
                            <option value="t">textarea</option>
                            <option value="s">select</option>
                            <option value="c">checkbox</option>
                            <option value="r">radio</option>
                        </select>-->
                        </div>
                        <?php                      
                    }   
                }
                
                ?>
                
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Buscar
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
