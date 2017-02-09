@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>{{ $title_head }}</h1>
        </div> 
        <div class="col-md-12">
            <a href="{{ URL::to(proyectosaperturas) }}" class="btn btn-success">Ver Todos</a>
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
        <form class="form-horizontal" role="form" method="POST" action="{{ url(proyectosaperturas) }}">
            {{ csrf_field() }}       
            

                <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                <label for="id" class="col-md-4 control-label">id</label>

                <div class="col-md-6">
                    <input id="id" type="text" class="form-control" name="id" value="{{ old('id') }}" autofocus>

                    @if ($errors->has('id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('id') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            

                <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                <label for="descripcion" class="col-md-4 control-label">descripcion</label>

                <div class="col-md-6">
                    <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" autofocus>

                    @if ($errors->has('descripcion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('descripcion') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            

                <div class="form-group{{ $errors->has('fecha_inicio') ? ' has-error' : '' }}">
                <label for="fecha_inicio" class="col-md-4 control-label">fecha_inicio</label>

                <div class="col-md-6">
                    <input id="fecha_inicio" type="text" class="form-control" name="fecha_inicio" value="{{ old('fecha_inicio') }}" autofocus>

                    @if ($errors->has('fecha_inicio'))
                    <span class="help-block">
                        <strong>{{ $errors->first('fecha_inicio') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            

                <div class="form-group{{ $errors->has('fecha_fin') ? ' has-error' : '' }}">
                <label for="fecha_fin" class="col-md-4 control-label">fecha_fin</label>

                <div class="col-md-6">
                    <input id="fecha_fin" type="text" class="form-control" name="fecha_fin" value="{{ old('fecha_fin') }}" autofocus>

                    @if ($errors->has('fecha_fin'))
                    <span class="help-block">
                        <strong>{{ $errors->first('fecha_fin') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            

                <div class="form-group{{ $errors->has('inversion') ? ' has-error' : '' }}">
                <label for="inversion" class="col-md-4 control-label">inversion</label>

                <div class="col-md-6">
                    <input id="inversion" type="text" class="form-control" name="inversion" value="{{ old('inversion') }}" autofocus>

                    @if ($errors->has('inversion'))
                    <span class="help-block">
                        <strong>{{ $errors->first('inversion') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            

                <div class="form-group{{ $errors->has('gastos') ? ' has-error' : '' }}">
                <label for="gastos" class="col-md-4 control-label">gastos</label>

                <div class="col-md-6">
                    <input id="gastos" type="text" class="form-control" name="gastos" value="{{ old('gastos') }}" autofocus>

                    @if ($errors->has('gastos'))
                    <span class="help-block">
                        <strong>{{ $errors->first('gastos') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            

                <div class="form-group{{ $errors->has('proyectos_estatus_id') ? ' has-error' : '' }}">
                <label for="proyectos_estatus_id" class="col-md-4 control-label">proyectos_estatus_id</label>

                <div class="col-md-6">
                    <input id="proyectos_estatus_id" type="text" class="form-control" name="proyectos_estatus_id" value="{{ old('proyectos_estatus_id') }}" autofocus>

                    @if ($errors->has('proyectos_estatus_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('proyectos_estatus_id') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            

                <div class="form-group{{ $errors->has('proyectos_definiciones_id') ? ' has-error' : '' }}">
                <label for="proyectos_definiciones_id" class="col-md-4 control-label">proyectos_definiciones_id</label>

                <div class="col-md-6">
                    <input id="proyectos_definiciones_id" type="text" class="form-control" name="proyectos_definiciones_id" value="{{ old('proyectos_definiciones_id') }}" autofocus>

                    @if ($errors->has('proyectos_definiciones_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('proyectos_definiciones_id') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            

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
@endsection
