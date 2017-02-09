@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>{{ $title_head }}</h1>
        </div> 
        <div class="col-md-12">
            <a href="{{ URL::to('proyectosaperturas/create') }}" class="btn btn-success">Agregar</a>
        </div>
    </div>
    
    <div class="row">         
        <?php
        if ($datos) {
            ?>                          
            <table class="table table-responsive" id="mi_tabla">
                <thead>
                    <tr>
                        <th>#</th>
                            <th>id</th>
                            <th>descripcion</th>
                            <th>fecha_inicio</th>
                            <th>fecha_fin</th>
                            <th>inversion</th>
                            <th>gastos</th>
                            <th>proyectos_estatus_id</th>
                            <th>proyectos_definiciones_id</th>

                        <th>ACCION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($datos as $row) {
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row->id?></td>
                            <td><?= $row->descripcion?></td>
                            <td><?= $row->fecha_inicio?></td>
                            <td><?= $row->fecha_fin?></td>
                            <td><?= $row->inversion?></td>
                            <td><?= $row->gastos?></td>
                            <td><?= $row->proyectos_estatus_id?></td>
                            <td><?= $row->proyectos_definiciones_id?></td>

                            <td>
                                <a href="{{ URL::to('proyectosaperturas') }}<?= '/' . $row->id ?>" title="ver registro" class="btn btn-info">Ver</a>
                                <a href="{{ URL::to('proyectosaperturas')}}<?= '/' . $row->id . '/edit' ?>" title="editar registro" class="btn btn-warning">Editar</a>

                                {{ Form::open(array('url' => 'proyectosaperturas/' . $row->id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                {{ Form::submit('Eliminar', 
                                                            array('class' => 'btn btn-danger',
                                                                'title'=>'eliminar registro',
                                                                'onclick'=>'return confirm("Eliminar este Registro?")')) 
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

