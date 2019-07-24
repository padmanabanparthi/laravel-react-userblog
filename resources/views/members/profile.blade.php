@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div style="min-height:400px;">
        
        <div class="row justify-content-center">
            <div class="col-md-12">
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
                    <div class="profile-createddate">
                        Registered Date: {{ $userInfo->created_at }}
                    </div>
                </div>
                <div class="pull-right">
                    <a href="{{url('/members/profile/edit')}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                </div>  
            </div>  
        </div>
    </div>
</div>
@endsection
