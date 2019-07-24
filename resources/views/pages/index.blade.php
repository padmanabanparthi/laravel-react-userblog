@extends('layouts.app')

@section('content')

{{-- @include('home-slider') --}}

<div class="container" style="margin-top:20px">
    <div class="row">
        <div class="col-md-12 hometop">
            <h1 class="section-heading">Neque porro quisquam est qui dolorem</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sit amet scelerisque neque. Curabitur convallis volutpat eleifend. Suspendisse metus ligula, gravida ut magna vitae, aliquam faucibus lorem. Etiam nulla nunc, interdum vitae gravida eleifend, varius vitae tortor. </p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="section-heading">Recent posts</h1>
        </div>
        @foreach ($posts as $post)
            <div class="col-md-4">
                <div class="card mb-4 box-shadow box-shadow hvr-grow-shadow">
                    <a href="{{ url('/blog/'.$post->id.'/'.$post->title) }}">
                    <img class="card-img-top" alt="{{ $post->title }}" style="height: 225px; width: 100%; display: block;" src="@if($post->featured_image) {{ asset('images/featured_images/'.$post->featured_image)}} @else {{ asset('images/placeholder.png')}} @endif" >
                    </a>
                    <div class="card-body" style="height:230px">
                        <h4 class="card-title" style="height:50px" title="{{ $post->title }}"><a href="{{ url('/blog/'.$post->id.'/'.$post->title) }}">{{str_limit($post->title, 50) }}</a></h4>
                        <p class="card-text" style="height:90px">{{ str_limit(strip_tags($post->content), 100) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            {{-- <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                            </div> --}}
                            <small class="text-muted">{{ date('d M,Y',strtotime($post->created_at)) }}</small>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
            
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <a class="btn btn-primary" href="{{ url('blog') }}">View All</a>
        </div>
    </div>
    
</div>
@endsection
