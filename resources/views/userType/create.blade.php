@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <h1>{{ $title_head }}</h1>
        </div> 
        <div class="col-md-12">
            <a href="{{ URL::to('userType') }}" class="btn btn-success">Ver Todos</a>
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
        <form class="form-horizontal" role="form" method="POST" action="{{ url('userType') }}">
            {{ csrf_field() }}       

            <div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
                <label for="descripcion" class="col-md-4 control-label">Descripcion</label>

                <div class="col-md-6">
                    <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" autofocus>

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
                        Registrar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
