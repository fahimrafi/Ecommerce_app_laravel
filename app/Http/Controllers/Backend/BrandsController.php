<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use DB;
use Image;
use File;
use Auth;
use App\Models\User; 

class BrandsController extends Controller
	{		
		public function __construct()
	    {
	        $this->middleware('auth');
	        
	    }


	    public function index(){	    	 
	        if (!Auth::user()->hasRole('admin')) 
	        {
	            return abort(401,"this action is not allowed");
	        }

			$brands = Brand::orderBy('id','desc')->get();
			return view('backend.pages.brand.index')->with('brands',$brands);
		}

		public function store(Request $request){
			if (!Auth::user()->hasRole('admin')) 
	        {
	            return abort(401,"this action is not allowed");
	        }
			//data validation

			$validatedData = $request->validate([
			'name' => 'required|max:150',			
			

			]);
		    
		    //insert product code starts
		    $brand = new Brand;
		    $brand->name = $request->name;
		    $brand->description = $request->description;
		    $brand->save();

		    if($request->image){

		    	$image = $request->file('image');		        
		        $img = str_random(6).date('h-i-s').time() . '.' . $image->getClientOriginalExtension();
		        $location = public_path('images/brands/' .$img);
		        Image::make($image)->save($location);
		        $brand->image =$img;    
    		}
    		$saved = $brand->save();
    		if($saved){
	        	$notification = array(
	            'message'=>'Successfully added',
	            'alert-type'=>'success'
	            );
	            return redirect()->route('admin.brands')->with($notification);
	        } else{
	            $notification = array(
	            'message'=>'Something went wrong!!',
	            'alert-type'=>'error'
	            );
	         return redirect()->route('admin.brands')->with($notification);
	        }

    		
		}

			
		

		public function create(){
			if (!Auth::user()->hasRole('admin')) 
	        {
	            return abort(401,"this action is not allowed");
	        }
			 
   			 return view('backend.pages.brand.create');
		}


		public function edit($id){
			if (!Auth::user()->hasRole('admin')) 
	        {
	            return abort(401,"this action is not allowed");
	        }
			 
			$brand = Brand::find($id);

			if (!is_null($brand)) {
				return view('backend.pages.brand.edit',compact('brand'));
			} else {
				return Redirect()->route('admin.brands');
			}
			
			
		}

		public function update(Request $request,$id){
			if (!Auth::user()->hasRole('admin')) 
	        {
	            return abort(401,"this action is not allowed");
	        }
			//data validation
			$validatedData = $request->validate([
			'name' => 'required|max:150',
			'image' => 'nullable|image',
			
			]);
			//insert product code starts

			$brand = Brand::find($id);
			$brand->name = $request->name;			
			if(!is_null($request->image)){
				//Delete the old images from folder


				if (File::exists('images/brands/'.$brand->image)) {
					File::delete('images/brands/'.$brand->image);
				}

				$image = $request->file('image');		        
		        $img = str_random(6).date('h-i-s').time() . '.' . $image->getClientOriginalExtension();
		        $location = public_path('images/brands/' .$img);
		        Image::make($image)->save($location);
		        $brand->image =$img;
			}			
			$updated= $brand->save();
			if($updated){
	        	$notification = array(
	            'message'=>'Successfully updated',
	            'alert-type'=>'success'
	            );
	            return back()->with($notification);
	        } else{
	            $notification = array(
	            'message'=>'Something went wrong!!',
	            'alert-type'=>'error'
	            );
	         return back()->with($notification);
	        }
			// return redirect()->route('admin.brands');
		}

					 // public function delete($id){
					 //       $brand   = DB::table('brands')->where('id',$id)->first();
					 //       $image = $brand->image;        
					 //       $delete = DB::table('brands')->where('id',$id)->delete();    
					 //        if($delete){
					 //        	$file_path = "images/brands/"."$image";
					 //        	unlink($file_path);
					 //            $notification = array(
					 //            'message'=>'Successfully deleted',
					 //            'alert-type'=>'success'
					 //            );
					 //            return Redirect()->route('admin.brands')->with($notification);
					 //        } else{
					 //            $notification = array(
					 //            'message'=>'Something went wrong!!',
					 //            'alert-type'=>'error'
					 //            );
					 //         return Redirect()->route('admin.brands')->with($notification);
					 //        }
						// }

		public function delete($id){
			if (!Auth::user()->hasRole('admin')) 
	        {
	            return abort(401,"this action is not allowed");
	        }
			$brand = Brand::find($id);

			if (!is_null($brand)) {
								

				//delete cat image
				if (File::exists('images/brands/'.$brand->image)) {
					File::delete('images/brands/'.$brand->image);
				}
				$delete = $brand->delete();
			}

			if($delete){
	        	$notification = array(
	            'message'=>'Successfully deleted',
	            'alert-type'=>'success'
	            );
	            return Redirect()->route('admin.brands')->with($notification);
	        } else{
	            $notification = array(
	            'message'=>'Something went wrong!!',
	            'alert-type'=>'error'
	            );
	         return Redirect()->route('admin.brands')->with($notification);
	        }
		}

}
