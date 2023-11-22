@extends('admin::layouts.master')

@section('content')
<div class="row mb-2">
    <div class="col-12">
        <div class="float-start"><h1>Manage Page Categories</h1></div>
        <div class="float-end">
            @can('pageCategory-create')
                <a class="btn btn-primary" href="{{ route('page-categories.create') }}">Create Category</a>
            @endcan
        </div>
    </div>
</div>

@include("admin::common.message")

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Title</th>
            <th>Parent</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($items as $key => $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->title }}</td>
        <td>{{ $category->parent_id == 0 ? 'Root' : $category->parent($category->parent_id)->title }}</td>
        <td>
            @can('pageCategory-edit')
            <a class="btn btn-primary" href="{{ url('/admin/page-categories/edit',['id' => $category->id]) }}"><i class="bi-pencil"></i></a>
            @endcan
            
            @can('pageCategory-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['page-categories.destroy', $category->id],'style'=>'display:inline']) !!}
                    {!! Form::button("<i class='bi-trash'></i>", ['class' => 'btn btn-danger btnDelete']) !!}
                {!! Form::close() !!}
            @endcan
        </td>
        
    </tr>
    @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">{!! $items->render()  !!}</td>
        </tr>
    </tfoot>
</table>

@endsection


@section('js-script')    
    <script src="{{ asset('/admin/js/common.js') }}"></script>
@endsection