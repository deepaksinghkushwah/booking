@extends('admin::layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New Permission</h2>
        </div>



    </div>
</div>

@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

{!! Form::open(array('route' => 'permissions.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
        <div class="form-group">
            <strong>Guard Name:</strong>
            {!! Form::text('guard_name', 'web', array('placeholder' => 'Guard Name','class' => 'form-control','readonly' => 'readonly')) !!}
        </div>
    </div>    
    <div class="col-xs-12 col-sm-12 col-md-12 mt-3">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-primary" href="{{ route('permissions.index') }}"> Back</a>
    </div>
</div>
{!! Form::close() !!}
@endsection
