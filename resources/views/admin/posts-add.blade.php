@extends('layouts.adminlte')

@section('title', 'Add Post')
@section('pageTitle', 'Add Post')
@section('pageDesc', 'sample desc')

@section('jsAssets')
<script src="https://cdn.ckeditor.com/ckeditor5/12.1.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection

@section('content')
<div class="box">
       
    <div class="box-body" style="padding:30px;min-height:400px;">     
        {{-- display the success and error messages --}}
        @include('admin.includes.messages')
        
        <form action="{{ url('/admin/posts') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
            @csrf
            
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="title">Featured image:</label>
                <input type="file" class="form-control" name="featured_image" id="title">
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" name="content" id="content" style="height:300px" row="10">{{ old('content') }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary hvr-glow">Submit</button>
        </form>
    </div>
</div>
@endsection


