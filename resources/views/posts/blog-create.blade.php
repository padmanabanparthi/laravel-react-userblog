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
            
            <form action="{{ url('/members/blog') }}" method="POST" enctype="multipart/form-data" autocomplete="off">
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
                    <textarea class="form-control" name="content" id="content" style="height:300px">{{ old('content') }}</textarea>
                </div>
                
                <button type="submit" class="btn btn-primary hvr-glow">Submit</button>
                <a href="{{ url('/members/my-posts') }}" class="btn btn-danger hvr-glow">Cancel</a>
            </form>
       </div>
    </div>
</div>
@endsection
