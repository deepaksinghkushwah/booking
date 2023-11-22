@extends('admin::layouts.master')
@section("title","Permissions")
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Permission Management</h2>
        </div>
        <div class="pull-right">
        @can('permission-create')
            <a class="btn btn-success" href="{{ route('permissions.create') }}"> Create New Permission</a>
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
    @foreach ($items as $key => $item)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $item->name }}</td>
        <td>            
            @can('permission-edit')
                <a class="btn btn-primary" href="{{ route('permissions.edit',$item->id) }}"><i class="bi-pencil"></i></a>
            @endcan
            @can('permission-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $item->id],'style'=>'display:inline']) !!}
                    {!! Form::button("<i class='bi-trash'></i>", ['class' => 'btn btn-danger btnDelete']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
    </tr>
    @endforeach
</table>

{!! $items->render() !!}
@endsection

@section('js-script')    
    <script src="{{ asset('/admin/js/common.js') }}"></script>
@endsection