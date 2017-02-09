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
    <div class="row">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('generador/find_table') }}">
            {{ csrf_field() }}       

            <div class="form-group{{ $errors->has('nombre_bd') ? ' has-error' : '' }}">
                <label for="nombre_bd" class="col-md-4 control-label">Nombre Base de datos</label>

                <div class="col-md-6">
                    <input id="nombre_bd" type="text" class="form-control" name="nombre_bd" value="{{ $nombre_bd }}" autofocus>

                    @if ($errors->has('nombre_bd'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre_bd') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group{{ $errors->has('nombre_tabla') ? ' has-error' : '' }}">
                <label for="nombre_tabla" class="col-md-4 control-label">Nombre Tabla</label>

                <div class="col-md-6">
                    <input id="nombre_tabla" type="text" class="form-control" name="nombre_tabla" value="{{ $nombre_tabla }}" autofocus>

                    @if ($errors->has('nombre_tabla'))
                    <span class="help-block">
                        <strong>{{ $errors->first('nombre_tabla') }}</strong>
                    </span>
                    @endif
                </div>
            </div>


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
@endsection
