<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

use App\Member;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['pageId'] = 15;

        $id =  Auth::id();
        $data['userInfo'] = Member::find($id)->withCount('posts')->first();
        
        //return $data['userInfo'];
        return view('members.home',$data);
    }

    public function profile()
    {
        $data['pageId'] = 15;

        $id =  Auth::id();
        $data['userInfo'] = Member::find($id)->withCount('posts')->first();
        
        //return $data['userInfo'];
        return view('members.profile',$data);
    }

    public function edit()
    {
        $id =  Auth::id();
        $data['pageId'] = 15;
        $data['userInfo'] = Member::find($id);
        //return $data['userInfo'];
        return view('members.profile-edit',$data);
    }


    public function update(Request $request)
    {
        $id =  Auth::id();
        $validatedData = $request->validate([
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'name' => 'required',
            'profile_image' => 'image|nullable|max:1999'
        ]);
        
        //handle the upload
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            //get filename with extension
            $fileNameWithExt = $image->getClientOriginalName();
            //get just filename
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            //get just ext
            $ext = $image->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$ext;
            // Upload Image with laravel default
            //$path = $request->file('profile_image')->storeAs('public/profile_image',$fileNameToStore);
            
            //another method for upload image
            $destinationPath = public_path('/images/profile_images');
            $image->move($destinationPath, $fileNameToStore);
        }

        $user = Member::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
       
        if ($request->hasFile('profile_image')) {
            $user->profile_image = $fileNameToStore;
        }
        $user->save();

        return redirect('/members/profile')->with("success" , "Successfully Updated");
    }
}
