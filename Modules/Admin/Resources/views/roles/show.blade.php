@extends('admin::layouts.master')


@section('content')

<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2> Show Role</h2>

        </div>

        
    </div>

</div>


<div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Name:</strong>

            {{ $role->name }}

        </div>

    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">

        <div class="form-group">

            <strong>Permissions:</strong><br>
            <dl style='padding-left: 10px;'>
            @if(!empty($rolePermissions))

                @foreach($rolePermissions as $v)

                <dd>{{ $v->name }}</dd>

                @endforeach

            @endif
            </dl>
            <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
        </div>

    </div>

</div>

@endsection
