<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use App\Models\Division;
use Auth;

class DistrictsController extends Controller
{
    public function __construct()
        {
            $this->middleware('auth');
        }
   public function index()
    {
        if (!Auth::user()->hasRole('admin')) 
            {
                return abort(401,"this action is not allowed");
            }
        $districts= District::orderBy('name','asc')->get();
        return view('backend.pages.districts.index',compact('districts'));
    }
    public function create()
    {
        if (!Auth::user()->hasRole('admin')) 
            {
                return abort(401,"this action is not allowed");
            }
        $divisions= Division::orderBy('priority','asc')->get();
        return view('backend.pages.districts.create',compact('divisions'));
    }
    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('admin')) 
            {
                return abort(401,"this action is not allowed");
            }
        $this->validate($request,[
            'name' => 'required',
            'division_id' => 'required',
        ],
           [
               'name.required' => 'please provide a district name',
               'division_id.required' =>'please provide a division for the district',
           ]);
        $district = new District();
        $district->name= $request->name;
        $district->division_id= $request->division_id;
        $district->save();
        session()->flash('success','A new district has added successfully !!');
        return redirect()->route('admin.districts');
    }
    public function edit($id)
    {
        if (!Auth::user()->hasRole('admin')) 
            {
                return abort(401,"this action is not allowed");
            }
        $divisions= Division::orderBy('priority','asc')->get();
        $district= District::find($id);
        if(!is_null($district))
        {
            return view('backend.pages.districts.edit',compact('district','divisions'));
        }
        else
        {
            return redirect()->route('admin.districts');
        }
    }
    public function update(Request $request,$id)
    {
        if (!Auth::user()->hasRole('admin')) 
            {
                return abort(401,"this action is not allowed");
            }
         $this->validate($request,[
            'name' => 'required',
            'division_id' => 'required',
        ],
           [
               'name.required' => 'please provide a division name',
               'division_id.required' =>'please provide a division for the district',
           ]);
        $district =  District::find($id);
        $district->name= $request->name;
        $district->division_id= $request->division_id;
        $district->save();
        
        session()->flash('success',' district has updated successfully !!');
        return redirect()->route('admin.districts');
            
    }
    public function delete($id)
    {
        if (!Auth::user()->hasRole('admin')) 
            {
                return abort(401,"this action is not allowed");
            }
        $district = District::find($id);
        if(!is_null($district))
        {
            $delete=  $district->delete();
        }
        


        if($delete){
            
            $notification = array(
            'message'=>'Successfully deleted',
            'alert-type'=>'success'
            );
            session()->flash('success','District has deleted successfully !!');
            return Redirect()->route('admin.districts')->with($notification);
        } else{
            $notification = array(
            'message'=>'Something went wrong!!',
            'alert-type'=>'error'
            );
         return Redirect()->route('admin.districts')->with($notification);
        }
        
        
}
}
