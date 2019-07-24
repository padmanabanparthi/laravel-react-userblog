<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Post as PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $posts = Post::with('member')->latest()->paginate(6);
        // ================= without where caluse =============/
        //$posts = Post::with('member')->latest()->get();

        // =================== with where clause
        // $posts = Post::with(['member' => function ($query) {
        //     $query->where('user_id', $id);
        // }])->latest()->get();
      
        
        //return $posts;
        $data['pageId'] = 11;
        $data['posts'] = $posts;
        return view('posts.blog',$data);
    }

    /**
     * list all posts for api
     *
     */
    public function all_post_for_api()
    {   
        $posts = Post::with('member')->latest()->paginate(6);
        return PostResource::collection($posts);
    }

    public function single_blog($id)
    {
        $data['pageId'] = 11;
        $postinfo = Post::find($id);
        $data['post'] = $postinfo;
        //return $postinfo;
        return view('posts.blog-detail',$data);
    }

    /**
     * get single post for api
     *
     */
    public function single_post_for_api($id)
    {   
        $post = Post::findOrFail($id);
        return new PostResource($post);
    }

    public function posts_by_member()
    {
        
        $uid =  Auth::id();
        $posts = Post::with('member')->where('user_id', $uid)->latest()->paginate(6);
       
        // ================= without where caluse =============/
        //$posts = Post::with('member')->latest()->get();

        // =================== with where clause
        // $posts = Post::with(['member' => function ($query) {
        //     $query->where('user_id', $id);
        // }])->latest()->get();
      
        
        //return $posts;
        $data['pageId'] = 11;
        $data['posts'] = $posts;
        return view('posts.blog',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageId'] = 11;
        return view('posts.blog-create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //return $request;
        $validatedData = $request->validate([
            'title' => 'required|max:191',
            'content' => 'required',
            'featured_image' => 'image|nullable|max:1999'
        ]);
        
        $fileNameToStore = NULL;
        //handle the upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            //get filename with extension
            $fileNameWithExt = $image->getClientOriginalName();
            //get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $ext = $image->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$ext;
            // Upload Image with laravel default
            //$path = $request->file('featured_image')->storeAs('public/featured_images',$fileNameToStore);
            
            //another method for upload image
            $destinationPath = public_path('/images/featured_images');
            $image->move($destinationPath, $fileNameToStore);
        }

        $post = new Post;
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::id();
        $post->featured_image = $fileNameToStore;
        $post->save();

        return redirect('/members/my-posts')->with("success" , "Post Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        $data['pageId'] = 11;
        $postinfo = Post::find($id);
        $data['postInfo'] = $postinfo;
        //return $postinfo;
        return view('posts.blog-detail',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['pageId'] = 11;
        $postinfo = Post::find($id);
        $data['postInfo'] = $postinfo;
        //return $data['userInfo'];
        return view('posts.blog-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:191',
            'content' => 'required',
            'featured_image' => 'image|nullable|max:1999'
        ]);
        
        //handle the upload
        if ($request->hasFile('featured_image')) {
            $image = $request->file('featured_image');
            //get filename with extension
            $fileNameWithExt = $image->getClientOriginalName();
            //get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $ext = $image->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$ext;
            // Upload Image with laravel default
            //$path = $request->file('featured_image')->storeAs('public/featured_images',$fileNameToStore);
            
            //another method for upload image
            $destinationPath = public_path('/images/featured_images');
            $image->move($destinationPath, $fileNameToStore);
        }

        $post = Post::find($id);
        $post->title = $request->title;
        $post->content = $request->content;
        if ($request->hasFile('featured_image')) {
            $post->featured_image = $fileNameToStore;
        }
        $post->save();
        return redirect('/members/my-posts')->with("success" , "Post Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);

        $post->delete();
        return redirect('/members/my-posts')->with("success" , "Post Deleted");
    }
}
