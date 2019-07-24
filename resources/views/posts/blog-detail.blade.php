@extends('layouts.app')


@section('content')

<div class="container" style="margin-top:20px">
    <div class="row">
        <div class="col-md-12 blog-detail">
            <div class="text-right">
                @can('isUser')
                    @if (Auth::id()==$post->user_id)
                        <form action="{{url('/members/blog/'.$post->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{url('/members/blog/'.$post->id.'/edit')}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                            <button data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm hvr-glow"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                            <a class="btn btn-info btn-sm" href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa fa-long-arrow-left"></i> Back</a>
                        </form>
                    @else
                        <a class="btn btn-info btn-sm" href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa fa-long-arrow-left"></i> Back</a>
                    @endif
                @else
                    <a class="btn btn-info btn-sm" href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa fa-long-arrow-left"></i> Back</a>
                @endcan
                
            </div>
            <h1 class="blog-detail-title">{{ $post->title }}</h1>
            <div class="blog-detail-info">
                
                <div class="userinfo userimage">
                    <img src="@if($post->member->profile_image) {{asset('images/profile_images')}}/{{ $post->member->profile_image }} @else {{asset('images/user.png')}} @endif" class="img-circle userphoto" alt="User Image">
                </div>
                <div class="userinfo username">
                    <small><strong>{{ $post->member->name }}</strong></small><br>
                    <small class="text-muted">{{ date('d M,Y',strtotime($post->created_at)) }}</small>
                </div>
            </div>
            @if($post->featured_image)
            <div class="blog-detail-image">
                <img src="{{ asset('images/featured_images/'.$post->featured_image)}}" data-holder-rendered="true">
            </div>
            @endif
            
            <div class="blog-detail-content" >
                <p class="blog-detail-text" >{!! $post->content !!}</p>
                <div class="d-flex justify-content-between align-items-center" style="clear:both">
                    {{-- <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
