@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>{{ $title_head }}</h1>
        </div> 
        <div class="col-md-12">
            <a href="{{ URL::to('user') }}" class="btn btn-success">Ver Todos</a>
            <a href="{{ URL::to('user/create') }}" class="btn btn-success">Agregar</a>
        </div>
    </div>

    <div class="row">         
        <h1>Mostrando: {{ $datos->name }}</h1>
        <div class="jumbotron text-center">
            <h2>{{ $datos->name }}</h2>
            <p>
                <strong>Username:</strong> {{ $datos->username }}<br>  
                <strong>Email:</strong> {{ $datos->email }}              
            </p>
        </div>
    </div>
</div>
</div>
@endsection
