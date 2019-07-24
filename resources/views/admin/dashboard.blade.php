@extends('layouts.adminlte')

@section('title', 'Dashboard')
@section('pageTitle', 'Dashboard')
@section('pageDesc', 'sample desc')

@section('content')
<div class="box">
   
    <div class="box-body">
        <div class="card">
            <div class="card-header"></div>
            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                You are logged in as <strong>Admin</strong>!
                <a href="{{ url('admin/users') }}" class="btn btn-primary hvr-glow">View Users</a>

               
            </div>
        </div>          
    </div>

</div>
@endsection


