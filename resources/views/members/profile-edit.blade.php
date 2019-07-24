@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div style="min-height:400px;">
        
        <div class="row justify-content-center">
            <div class="col-md-12">
            {{-- display the success and error messages --}}
        @include('admin.includes.messages')
        
        <form action="{{ url('/members/profile/update') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" value="{{ $userInfo->name }}">
            </div>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" name="email" id="email" value="{{ $userInfo->email }}" autocomplete="nope">
            </div>
                       
            <div class="form-group">
                <label for="title">Profile image:</label>
                @if ($userInfo->profile_image)
                    <img src="{{ asset('/images/profile_images/'.$userInfo->profile_image) }}" style="width:250px" />
                @endif
                <input type="file" class="form-control" name="profile_image" id="title">
            </div>
            <button type="submit" class="btn btn-primary hvr-glow">Update</button>
            <a href="{{ url('/members/profile') }}" class="btn btn-danger hvr-glow">Cancel</a>
        </form>
        </div> 
        </div>
    </div>
</div>
@endsection
