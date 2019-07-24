@extends('layouts.adminlte')

@section('title', 'View Post')
@section('pageTitle', 'View Post')
@section('pageDesc', 'sample desc')

@section('content')
<div class="box">
       
    <div class="box-body" style="padding:30px">     
        <div class="pull-right">
            <a href="{{url('/admin/posts/'.$postInfo->id.'/edit')}}" class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
            <a class="btn btn-info btn-sm" href="/admin/posts"><i class="fa fa-long-arrow-left"></i> Back</a>
        </div>
       
        <div class="form-group">
            <label for="title">Author:</label>
            <span>{{ $postInfo->member->name }}</span>
        </div>
        <div class="form-group">
            <label for="title">Title:</label>
            <span>{{ $postInfo->title }}</span>
        </div>

        <div class="form-group">
            <label for="title">Featured Image:</label>
            @if ($postInfo->featured_image)
                <img src="{{ asset('/images/featured_images/'.$postInfo->featured_image) }}" style="width:50%" />
            @endif
        </div>
        
        <div class="form-group">
            <label for="content">Content:</label>
            <span>{!! $postInfo->content !!}</span>
        </div>
           
    </div>
</div>
@endsection


