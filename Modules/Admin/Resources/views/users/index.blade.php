@extends('admin::layouts.master')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Users Management</h2>
        </div>
        <div class="pull-right">
        @can('user-create')
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
            @endcan
        </div>
    </div>
</div>

@include("admin::common.message")

<table class="table table-bordered mt-3">
  <tr>
     <th>No</th>
     <th>Name</th>
     <th width="280px">Action</th>
  </tr>
    @foreach ($users as $key => $user)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $user->email }}</td>
        <td>            
            @can('user-edit')
                <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}"><i class="bi-pencil"></i></a>
            @endcan
            @can('user-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                    {!! Form::button("<i class='bi-trash'></i>", ['class' => 'btn btn-danger btnDelete']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>

{!! $users->render() !!}
@endsection

@section('js-script')    
    <script src="{{ asset('/admin/js/common.js') }}"></script>
@endsection