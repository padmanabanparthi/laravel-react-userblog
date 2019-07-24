@extends('layouts.adminlte')

@section('title', 'Posts')
@section('pageTitle', 'Posts')
@section('pageDesc', 'sample desc')

@section('cssAssets')
     <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection

@section('jsAssets')
    <!-- DataTables -->
    <script src="{{ asset('adminlte') }}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('adminlte') }}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script>
    $(function () {
        $('#example1').DataTable()
        $('#example2').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
        })
    })
    </script>
@endsection


@section('content')
<div class="box">
    <div class="box-header" >
        <h3 class="box-title"></h3>
        <div class="box-tools pull-right" style="padding-top:10px">
            <a href="{{ url('admin/posts/create') }}" class="btn btn-success btn-sm hvr-glow"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
        </div>
    </div>
   
    <div class="box-body table-responsive" style="padding:30px">        
        {{-- display the success and error messages --}}
        @include('admin.includes.messages')
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th style="width:40px">#</th>
                    <th >Featured Image</th>
                    <th style="width:150px">Title</th>
                    <th>Content</th>
                    <th>Author</th>
                    <th>Created Date</th>
                    <th style="width:150px">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if ($post->featured_image)
                            <img src="{{ asset('/images/featured_images/'.$post->featured_image) }}" style="width:80px" />
                        @endif
                    </td>
                    <td>{{ $post->title }}</td>
                    <td>{!! str_limit($post->content, 129); !!} <a href="{{ url('/admin/posts/'.$post->id) }}">@if(strlen($post->content)>150) Read more @endif</a></td>
                    <td>
                        <a href="{{ url('/admin/users/'.$post->member->id) }}">{{ $post->member->name }}</a>
                    </td>
                    <td>{{ date("d-M-Y h:i A",strtotime($post->created_at)) }}</td>
                    <td>
                       
                        <form method="post" action="{{ url('/admin/posts/'.$post->id) }}">
                            @csrf
                            @method("DELETE")
                            <a data-toggle="tooltip" data-placement="top" title="View" href="{{ url('/admin/posts/'.$post->id) }}" class="btn btn-primary btn-sm hvr-glow"><i class="fa fa-eye" aria-hidden="true"></i></a>
                             <a data-toggle="tooltip" data-placement="top" title="edit" href="{{ url('/admin/posts/'.$post->id.'/edit') }}" class="btn btn-info btn-sm hvr-glow"><i class="fa fa-edit" aria-hidden="true"></i></a>
                            <button data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm hvr-glow"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
              
            </tbody>
           
        </table>
    </div>
</div>
@endsection


