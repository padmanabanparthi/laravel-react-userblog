@extends('layouts.app')

@section('jsAssets')
<script src="{{ asset('/plugins/tinymce/tinymce.min.js') }}"></script>
 <script>
    tinymce.init({
  selector: 'textarea',
  height: 500,
  theme: 'modern',
  plugins: 'print preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
  toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ]
 });
 </script>
@endsection


@section('content')

<div class="container" style="margin-top:20px">
    
    <div class="row">
       <div class="col-md-12">
            {{-- display the success and error messages --}}
            @include('admin.includes.messages')
            
            <form action="{{ url('/members/blog/'.$postInfo->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" id="title" value="{{ $postInfo->title }}">
                </div>
                <div class="form-group">
                    <label for="title">Featured image:</label>
                    @if ($postInfo->featured_image)
                        <img src="{{ asset('/images/featured_images/'.$postInfo->featured_image) }}" style="width:50%" />
                    @endif
                    <input type="file" class="form-control" name="featured_image" id="title">
                </div>
                <div class="form-group">
                    <label for="content">Content:</label>
                    <textarea class="form-control" name="content" id="content" style="height:300px">{!! $postInfo->content !!}</textarea>
                </div>
                
                <button type="submit" class="btn btn-primary hvr-glow">Update</button>
                <a href="{{ url('/members/my-posts') }}" class="btn btn-danger hvr-glow">Cancel</a>
            </form>
       </div>
    </div>
</div>
@endsection
