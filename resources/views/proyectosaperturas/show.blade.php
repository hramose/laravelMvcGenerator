@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>{{ $title_head }}</h1>
        </div> 
        <div class="col-md-12">
            <a href="{{ URL::to('proyectosaperturas') }}" class="btn btn-success">Ver Todos</a>
            <a href="{{ URL::to('proyectosaperturas/create') }}" class="btn btn-success">Agregar</a>
        </div>
    </div>

    <div class="row">         
        <h1>Mostrando</h1>
        <div class="jumbotron text-center">
            <h2>Registro</h2>
            <p>
            
            
                <strong>id:</strong> {{ $datos->id }}<br> 
                    
            
                <strong>descripcion:</strong> {{ $datos->descripcion }}<br> 
                    
            
                <strong>fecha_inicio:</strong> {{ $datos->fecha_inicio }}<br> 
                    
            
                <strong>fecha_fin:</strong> {{ $datos->fecha_fin }}<br> 
                    
            
                <strong>inversion:</strong> {{ $datos->inversion }}<br> 
                    
            
                <strong>gastos:</strong> {{ $datos->gastos }}<br> 
                    
            
                <strong>proyectos_estatus_id:</strong> {{ $datos->proyectos_estatus_id }}<br> 
                    
            
                <strong>proyectos_definiciones_id:</strong> {{ $datos->proyectos_definiciones_id }}<br> 
                    
</p>
            
        </div>
    </div>
</div>
</div>
@endsection

