<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Models\Division;
use App\Models\District;
use Hash;

class UsersController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }


    public function dashboard(){
    	$user= Auth::user();
        if (!$user->hasRole('customer')) 
        {
            return abort(401,"this action is not allowed");
        }
    	return view('frontend.pages.users.dashboard',compact('user'));
    }


    public function profile(){
        if (!$user->hasRole('customer')) 
        {
            return abort(401,"this action is not allowed");
        }
        
    	$districts= District::orderBy('name','asc')->get();
        $divisions= Division::orderBy('priority','asc')->get();
    	$user= Auth::user();
        
    	return view('frontend.pages.users.profile',compact('user','districts','divisions'));
    }
    
    public function update(Request $request){
    	
    	$user= Auth::user();
        if (!$user->hasRole('customer')) 
        {
            return abort(401,"this action is not allowed");
        }
        $this->Validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'required|string|min:8|confirmed',
            'division_id' => 'required|numeric',
            'district_id' => 'required|numeric',
            'phone_no' => 'required|max:15|unique:users,phone_no,'.$user->id,
            'street_address' => 'required|max:100',            
            'username' => 'nullable|string|max:255|unique:users,username,'.$user->id,
        ]);
        if ($request->email!=$user->email) {
            $user->email_verified_at= NULL;
        }
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_no = $request->phone_no;
        $user->password = Hash::make($request->password);
        $user->division_id = $request->division_id;
        $user->district_id = $request->district_id;
        $user->street_address = $request->street_address;
        $user->shipping_address = $request->shipping_address;
        $user->username = $request->username;
        $user->ip_address = request()->ip();

        $user->save();

        session()->flash('success','User Profile has been updated successfully');
        return back();
    
    
}
}