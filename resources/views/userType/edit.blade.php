@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>{{ $title_head }}</h1>
        </div> 
        <div class="col-md-12">
            <a href="{{ URL::to('userType') }}" class="btn btn-success">Ver Todos</a>
            <a href="{{ URL::to('userType/create') }}" class="btn btn-success">Agregar</a>
        </div>
    </div>
</div>


<div class="container"> 
    <div class="row">        
        {{ Form::model($datos, 
                    array('route' => array('userType.update', $datos->id), 
                    'method' => 'PUT', 
                    'class'=>'form-horizontal', 
                    'role'=>'form')) }}      

            <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                <label for="descripcion" class="col-md-4 control-label">Descripcion</label>

                <div class="col-md-6">
                    <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ $datos->descripcion }}" autofocus>

                    @if ($errors->has('descripcion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('descripcion') }}</strong>
                    </span>
                    @endif
                </div>
            </div>            

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
