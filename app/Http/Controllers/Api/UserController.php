<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

use App\Member;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Member::withCount('posts')->latest()->paginate(5);
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'usertype' => 'required',
            'email' => 'required|unique:users|max:255',
            'name' => 'required',
            'password' => 'required|confirmed|min:6',
            'profile_image' => 'image|nullable|max:1999'
        ]);

        if ($validator->fails()) {
            //Session::flash('error', $validator->messages()->first());
            //return redirect()->back()->withInput();
            $data["status"] = "fail"; 
            $data["msg"] = $validator->messages();
            return response()->json($data);
       }
       else{
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

            $data["status"] = "success"; 
            $data["msg"] = "User Added Successfully";
            return response()->json($data);
       }        
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member =  Member::find($id);
        if ($member) {
            $data["status"] = "success"; 
            $data["msg"] = "Success";
            $data["user"] = $member;
            return response()->json($data);
        } else {
            $data["status"] = "fail"; 
            $data["msg"] = "No user found".$id;
            return response()->json($data);
        }
       
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
        $validator = Validator::make($request->all(),[
            'usertype' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'name' => 'required',
            'profile_image' => 'image|nullable|max:1999'
        ]);

        if ($validator->fails()) {
            //Session::flash('error', $validator->messages()->first());
            //return redirect()->back()->withInput();
            $data["status"] = "fail"; 
            $data["msg"] = $validator->messages();
            return response()->json($data);
       }
       else{
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

            $data["status"] = "success"; 
            $data["msg"] = "User Updated Successfully";
            return response()->json($data);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
