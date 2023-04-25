<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Session;
use Hash;
use Validator;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public $imageName = '';
    public function showView()
    {
        $homedata = User::all();
    	return view('admin.showUserView',compact('homedata'));
    }


    public function showUserForm()
    {
    	return view('admin.showUserForm');	
    }

    public function createUser(Request $request)
    {
        try{
        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'phone' => 'required|integer|min:10',
        ]);
        if($validator->fails())
        {
            return back()->with(['error'=>$validator->errors()->first()]);
        }
       
       $user = new User();
    	$user->name = $request->input('name');
    	$user->lastname = $request->input('lastname');
    	$user->email = $request->input('email');
    	$user->country = $request->input('country');
    	$user->city = $request->input('city');
    	$user->address = $request->input('address');
    	$user->phone = $request->input('phone');
    	$user->zipcode = $request->input('zipcode');
    	$user->state = $request->input('state');
    	$user->password = Hash::make($request->input('password'));
    	$imgName = "";
        if ($image = $request->file('image'))
        {
            $validatorr = Validator::make($request->all(),[
                'image' => 'required|image|mimes:jpeg,png,jpg',
            ]);
            if($validatorr->fails())
            {
                return back()->with(['error'=>$validatorr->errors()->first()]);
            }
            $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $imgName = $imageName;
            $path = public_path().'/adminTheme/uploads/users';
            $image->move($path, $imageName);                
        }
            
            $user->image = $imgName;
    	    $user->save();
    	    return back()->with('success','User Created Successfully');
        }catch(\Exception $e)
        {
            return back()->with(['error'=>$e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.useredit',compact('user'));
    }

    public function update(Request $request, $id)
    {
        try{

        $user = User::find($id);
        if($user){
            $validator = Validator::make($request->all(),[
                'name' => 'required|min:3',
                'email' => 'required|unique:users,email,'.$user->id,
                'phone' => 'required|integer|min:10',
            ]);
            if($validator->fails())
            {
                return back()->with(['error'=>$validator->errors()->first()]);
            }
    
            $user->name = $request->input('name');
            $user->lastname = $request->input('lastname');
            $user->email =  $user->email;
            $user->country = $request->input('country');
            $user->city = $request->input('city');
            $user->address = $request->input('address');
            $user->phone = $request->input('phone');
            $user->zipcode = $request->input('zipcode');
            $user->state = $request->input('state');
    
            if ($image = $request->file('image')) {
    
                $validatorr = Validator::make($request->all(),[
                    'image' => 'image|mimes:jpeg,png,jpg',
                ]);
                if($validatorr->fails())
                {
                    return back()->with(['error'=>$validatorr->errors()->first()]);
                }
                       $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
                       $this->imageName = $imageName;
                       $path = public_path().'/adminTheme/uploads/users';
                       $image->move($path, $imageName);
                }
    
            if($this->imageName != "")
            {
                $user->image = $this->imageName;
            }
    
            $user->save();
            return back()->with('success','Record updated Successfully');
        }
       else
       {
        return redirect()->with(['error'=>'User Does not exists']);
       }
    }catch(\Exception $e)
    {
        return redirect('admin/users')->with(['error'=>$e->getMessage()]);
    }
    }


    public function destroy($id)
    {
       $user = User::find($id);
       $user->delete();
       session::flash('success','Record has been deleted Successfully');
       return redirect('admin/users');
        
    }
}
