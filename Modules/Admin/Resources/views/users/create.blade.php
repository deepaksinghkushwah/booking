@extends('admin::layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Create New User</h2>
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

{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Name:</strong>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::text('password', null, array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
    </div>


    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <fieldset>
                <legend>Roles:</legend>
                <div class="row row-cols-3">
                    @foreach ($roles as $key => $role)
                    <div class="col">
                        {{ $checked = false }}
                        @if ($role->id == 2)
                        {!! Form::checkbox('roles[]', $role->id, true) !!} <label for="roles">{{$role->name}}</label><br>
                        @else
                        {!! Form::checkbox('roles[]', $role->id, false) !!} <label for="roles">{{$role->name}}</label><br>
                        @endif
                    </div>
                    @endforeach
                </div>
            </fieldset>
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <fieldset>
                <legend>Permissions:</legend>
                <div class="row row-cols-3">
                    @foreach ($permissions as $key => $permission)     
                    <div class="col">
                        <label for="permissions[]">{!! Form::checkbox('permissions[]', $permission->id) !!} {{$permission->name}}</label>
                    </div>
                    @endforeach
                </div>
            </fieldset>
        </div>
    </div>


    <div class="col-xs-12 col-sm-12 col-md-12 text-left">
        <button type="submit" class="btn btn-primary">Submit</button>
        <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
    </div>
</div>
{!! Form::close() !!}
@endsection
