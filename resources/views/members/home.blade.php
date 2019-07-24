@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div style="min-height:400px;">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p>Welcome back <strong>{{ Auth::user()->name }}!!  </strong></p>
                {{-- <p>You have <a href="{{ url('members/my-posts') }}">{{ $userInfo->posts_count }}</a> posts</p> --}}
            </div>  
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a class="small-box-link" href="{{ url('members/my-posts') }}">
                    <div class="small-box hvr-glow">
                        <div class="inner">
                            <h3>Posts</h3>
                            <p>{{ $userInfo->posts_count }} Posts</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-newspaper-o"></i>
                        </div>
                        <span class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></span>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a class="small-box-link" href="{{ url('members/profile') }}">
                    <div class="small-box hvr-glow">
                        <div class="inner">
                            <h3>My Profile</h3>
                            <p>View your profile</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user-o"></i>
                        </div>
                        <span class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></span>
                    </div>
                </a>
            </div>
        </div>
           
    </div>
</div>
@endsection
