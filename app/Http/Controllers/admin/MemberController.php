<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

use App\Member;

class MemberController extends Controller
{
    private $pageId = 2;

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pageId'] = $this->pageId;
        $data['users'] = Member::withCount('posts')->latest()->get();
        //return $data['users'];

        return view('admin.members',$data);
    }

    public function userslistReact()
    {
        $data['pageId'] = $this->pageId;
        $data['users'] = Member::withCount('posts')->latest()->get();
        //return $data['users'];

        return view('admin.membersReact',$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['pageId'] = $this->pageId;
        return view('admin.members-add',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'usertype' => 'required',
            'email' => 'required|unique:users|max:255',
            'name' => 'required',
            'password' => 'required|confirmed|min:6',
            'profile_image' => 'image|nullable|max:1999'
        ]);

        $fileNameToStore = NULL;
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

        $user = new Member;
        $user->profile_image = $fileNameToStore;
        $user->name = $request->name;
        $user->usertype = $request->usertype;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect('/admin/users')->with("success" , "User Created");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['pageId'] = $this->pageId;
        $data['userInfo'] = Member::find($id);
       // return $data['userInfo']->posts;
        return view('admin.members-view',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['pageId'] = $this->pageId;
        $data['userInfo'] = Member::find($id);
        //return $data['userInfo'];
        return view('admin.members-edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'usertype' => 'required',
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
        $user->usertype = $request->usertype;
        $user->email = $request->email;
        if ($id != 2) {
            $user->status = $request->status;
        } 
        if ($request->hasFile('profile_image')) {
            $user->profile_image = $fileNameToStore;
        }
        $user->save();

        return redirect('/admin/users')->with("success" , "User Updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = member::find($id);

        $user->delete();
        return redirect('/admin/users')->with("success" , "User Deleted");
    }
}
