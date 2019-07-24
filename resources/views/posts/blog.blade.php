@extends('layouts.app')

@section('cssAssets')
<style>
.member-blog-list .card-title{
    font-size:20px;
    height:55px;
}
.member-blog-list .card-text{
    height:130px
}
.member-blog-list .card-body{
    height:280px
}

.blog-list .card-title{
    height:55px;
}
.blog-list .card-text{
    height:90px
}
.blog-list .card-body{
    height:250px
}
</style>
@endsection

@section('content')

<div class="container" style="margin-top:20px">
    
    <div class="row">
        @if (url()->current()== url('')."/members/my-posts")
            <div class="col-md-12" style="padding-top:10px">
                <a href="{{ url('members/blog/create') }}" class="btn btn-success btn-sm hvr-glow pull-right"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
            </div>
            <div class="col-md-12 mt-4">
               @include('admin.includes.messages')
            </div>
        @endif
    </div>
    <div class="row">
        @if (count($posts)>0)
            @foreach ($posts as $post)
                @if (url()->current()== url('')."/members/my-posts")
                <div class="col-md-4 col-sm-12 member-blog-list">
                @else
                <div class="col-md-6 blog-list">
                @endif
                    <div class="card mb-4 hvr-shadow-radial">
                        <a href="{{ url('/blog/'.$post->id.'/'.$post->title) }}">
                        <img class="card-img-top" alt="{{ $post->title }}" style="height: 280px; width: 100%; object-fit:cover; display: block;" src="@if($post->featured_image) {{ asset('images/featured_images/'.$post->featured_image)}} @else {{ asset('images/placeholder.png')}} @endif" >
                        </a>
                        <div class="card-body" >
                            <h3 class="card-title" title="{{ $post->title }}"><a href="{{ url('/blog/'.$post->id.'/'.$post->title) }}">{{str_limit($post->title, 65) }}</a></h3>
                            <p class="card-text" >{{ str_limit(strip_tags($post->content), 150) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                
                                @if (url()->current()== url('')."/members/my-posts")
                                    @can('isUser')
                                        @if (Auth::id()==$post->user_id)
                                            <form action="{{url('/members/blog/'.$post->id)}}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <a href="{{url('/members/blog/'.$post->id.'/edit')}}" class="btn btn-sm btn-success hvr-glow"><i class="fa fa-edit"></i> Edit</a>
                                                <button data-toggle="tooltip" data-placement="top" title="Delete" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm hvr-glow"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        @endif
                                    @endcan
                                @else
                                    <small>
                                        <img src="@if($post->member->profile_image) {{asset('images/profile_images')}}/{{ $post->member->profile_image }} @else {{asset('images/user.png')}} @endif" class="img-circle userphoto" alt="User Image">
                                        <strong>{{ $post->member->name }}</strong>
                                    </small>
                                @endif
                               
                                <small class="text-muted">{{ date('d M,Y',strtotime($post->created_at)) }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row">
            {{-- {{ $posts->links() }} --}}
            {{ $posts->links() }}  
        @else
            <div class="col-md-12" style="text-align:center">
               <div class="card mt-3">
                <div class="alert">
                     <p>No posts available!!</p>
                </div>
               </div>
            </div>
        @endif
    </div>
</div>
@endsection
