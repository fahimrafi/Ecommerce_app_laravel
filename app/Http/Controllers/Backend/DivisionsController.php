<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\District;
use Auth;

class DivisionsController extends Controller
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
        $divisions= Division::orderBy('priority','asc')->get();
        return view('backend.pages.divisions.index',compact('divisions'));
    }
    public function create()
    {
        if (!Auth::user()->hasRole('admin')) 
            {
                return abort(401,"this action is not allowed");
            }
        return view('backend.pages.divisions.create');
    }
    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('admin')) 
            {
                return abort(401,"this action is not allowed");
            }
        $this->validate($request,[
            'name' => 'required',
            'priority' => 'required',
        ],
           [
               'name.required' => 'please provide a division name',
               'priority.required' =>'please provide a division priority',
           ]);
        $division = new Division();
        $division->name= $request->name;
        $division->priority= $request->priority;
        $division->save();
        session()->flash('success','A new division has added successfully !!');
        return redirect()->route('admin.divisions');
    }
    public function edit($id)
    {
        if (!Auth::user()->hasRole('admin')) 
            {
                return abort(401,"this action is not allowed");
            }
        $division= Division::find($id);
        if(!is_null($division))
        {
            return view('backend.pages.divisions.edit',compact('division'));
        }
        else
        {
            return redirect()->route('admin.divisions');
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
            'priority' => 'required',
        ],
           [
               'name.required' => 'please provide a division name',
               'priority.required' =>'please provide a division priority',
           ]);
        $division =  Division::find($id);
        $division->name= $request->name;
        $division->priority= $request->priority;
        $division->save();
        
        session()->flash('success',' division has updated successfully !!');
        return redirect()->route('admin.divisions');
            
    }
    public function delete($id)
    {
        if (!Auth::user()->hasRole('admin')) 
            {
                return abort(401,"this action is not allowed");
            }
        $division = Division::find($id);
        if(!is_null($division))
        {
            $districts = District::where('division_id',$division->id)->get();
            foreach($districts as $district)
            {
                $district->delete();
            }
            $division->delete();
        }
        session()->flash('success','Division has deleted successfully !!');
        return back();
    }
}
