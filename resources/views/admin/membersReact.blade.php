@extends('layouts.adminlte')

@section('title', 'Users')
@section('pageTitle', 'Users')
@section('pageDesc', 'sample desc')

@section('cssAssets')
     <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('adminlte') }}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection

@section('jsAssets')
    
@endsection


@section('content')
<div class="box">
    {{-- <div class="box-header" >
        <h3 class="box-title"></h3>
        <div class="box-tools pull-right" style="padding-top:10px">
            <a href="{{ url('admin/users/create') }}" class="btn btn-success btn-sm hvr-glow"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
        </div>
    </div> --}}
   
    <div class="box-body table-responsive" style="padding:30px">    
         
        {{-- display the success and error messages --}}
        @include('admin.includes.messages')
        <div id="userapp"></div>
        
    </div>
</div>
@endsection
