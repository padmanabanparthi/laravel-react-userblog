@extends('layouts.adminlte')

@section('title', 'View User')
@section('pageTitle', 'View User')
@section('pageDesc', 'sample desc')

@section('content')
<div class="box">
       
    <div class="box-body" style="padding:30px">     
        <div class="profile-header">
            <img src="@if($userInfo->profile_image) {{asset('images/profile_images')}}/{{ $userInfo->profile_image }} @else {{asset('images/user.png')}} @endif" class="img-circle" />
        </div>

        <div class="profile-description">
            <div class="profile-status">
                @if ($userInfo->status==1) 
                    <span class="active">Active<span>
                @else
                    <span class="inactive">Deactive<span>
                @endif
            </div>
            <h1 class="profile-name">{{ $userInfo->name }}</h1>
            
            <p><i class="fa fa-envelope"></i> {{ $userInfo->email }}</p>
            <p><span class="usertype">{{ $userInfo->usertype }}</span></p>
            <div class="profile-createddate">
                Registered Date: {{ $userInfo->created_at }}
            </div>
        </div>
        <div class="pull-right">
            <a href="{{url('/admin/users/'.$userInfo->id.'/edit')}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
            <a class="btn btn-info btn-sm" href="/admin/users"><i class="fa fa-long-arrow-left"></i> Back</a>
        </div>  
          
        
        
    </div>
</div>
@endsection


