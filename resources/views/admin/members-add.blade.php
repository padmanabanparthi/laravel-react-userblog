@extends('layouts.adminlte')

@section('title', 'Add User')
@section('pageTitle', 'Add User')
@section('pageDesc', 'sample desc')

@section('content')
<div class="box">
       
    <div class="box-body" style="padding:30px">     
        {{-- display the success and error messages --}}
        @include('admin.includes.messages')
        
        <form action="{{ url('/admin/users') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="usertype">User type:</label>
                <select class="form-control" name="usertype" id="usertype">
                    <option value="">Select</option>
                    <option value="admin" @if (old('usertype')=="admin") selected  @endif>Admin</option>
                    <option value="user" @if (old('usertype')=="user") selected  @endif>User</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
            </div>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}" autocomplete="nope">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" name="password" id="pwd" value="" autocomplete="new-password">
            </div>
            <div class="form-group">
                <label for="pwd">Confirm Password:</label>
                <input type="password" class="form-control" name="password_confirmation" id="pwd" value="" autocomplete="new-password">
            </div>
            <div class="form-group">
                <label for="title">Profile image:</label>
                <input type="file" class="form-control" name="profile_image" id="title">
            </div>
            <button type="submit" class="btn btn-primary hvr-glow">Add</button>
        </form>
    </div>
</div>
@endsection


