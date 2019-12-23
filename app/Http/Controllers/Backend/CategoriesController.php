<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use DB;
use Image;
use File;
use Auth;

class CategoriesController extends Controller
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
			$categories = Category::orderBy('id','desc')->get();
			return view('backend.pages.category.index')->with('categories',$categories);
		}

		public function store(Request $request){
			if (!Auth::user()->hasRole('admin')) 
	        {
	            return abort(401,"this action is not allowed");
	        }
			//data validation

			$validatedData = $request->validate([
			'name' => 'required|max:150',			
			'parent_id' => 'nullable|numeric',

			]);
		    
		    //insert category code starts
		    $category = new category;
		    $category->name = $request->name;
		    $category->description = $request->description;
		    $category->parent_id = $request->parent_id;   
		    
		    if($request->image){

		    	$image = $request->file('image');		        
		        $img = str_random(6).date('h-i-s').time() . '.' . $image->getClientOriginalExtension();
		        $location = 'images/categories/'.$img;
		        Image::make($image)->save($location);
		        $category->image =$img;    
    		}
    		
    		$saved = $category->save();

    		// notification
    		if($saved){
	        	$notification = array(
	            'message'=>'Successfully added',
	            'alert-type'=>'success'
	            );
	            return redirect()->route('admin.categories')->with($notification);
	        } else{
	            $notification = array(
	            'message'=>'Something went wrong!!',
	            'alert-type'=>'error'
	            );
	         return redirect()->route('admin.categories')->with($notification);
	        }
	        // -notification

    		
		}

			
		

		public function create(){
			if (!Auth::user()->hasRole('admin')) 
	        {
	            return abort(401,"this action is not allowed");
	        }
			 $main_categories = Category::orderBy('name','desc')->where('parent_id',NULL)->get();
   			 return view('backend.pages.category.create',compact('main_categories'));
		}


		public function edit($id){
			if (!Auth::user()->hasRole('admin')) 
	        {
	            return abort(401,"this action is not allowed");
	        }
			$main_category = Category::orderBy('name','desc')->where('parent_id',NULL)->get(); 
			$category = Category::find($id);

			if (!is_null($category)) {
				return view('backend.pages.category.edit',compact('main_category','category'));
			} else {
				return Redirect()->route('admin.categories');
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
			'parent_id' => 'nullable|numeric',
			]);
			//insert product code starts

			$category = Category::find($id);
			$category->name = $request->name;
			$category->parent_id = $request->parent_id;
			if(count($request->image) > 0){
				//Delete the old images from folder


				if (File::exists('images/categories/'.$category->image)) {
					File::delete('images/categories/'.$category->image);
				}

				$image = $request->file('image');		        
		        $img = str_random(6).date('h-i-s').time() . '.' . $image->getClientOriginalExtension();
		        $location = 'images/categories/' .$img;
		        Image::make($image)->save($location);
		        $category->image =$img; 

			}			
			$updated= $category->save();
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
			
		}

					 // public function delete($id){
					 //       $category   = DB::table('categories')->where('id',$id)->first();
					 //       $image = $category->image;        
					 //       $delete = DB::table('categories')->where('id',$id)->delete();    
					 //        if($delete){
					 //        	$file_path = "images/categories/"."$image";
					 //        	unlink($file_path);
					 //            $notification = array(
					 //            'message'=>'Successfully deleted',
					 //            'alert-type'=>'success'
					 //            );
					 //            return Redirect()->route('admin.categories')->with($notification);
					 //        } else{
					 //            $notification = array(
					 //            'message'=>'Something went wrong!!',
					 //            'alert-type'=>'error'
					 //            );
					 //         return Redirect()->route('admin.categories')->with($notification);
					 //        }
						// }

		public function delete($id){
			if (!Auth::user()->hasRole('admin')) 
	        {
	            return abort(401,"this action is not allowed");
	        }
			$category = Category::find($id);

			if (!is_null($category)) {
				//if it is parent then deletes all sub cat
				if ($category->parent_id==NULL) {
					//delete sub cat
					$sub_category = Category::orderBy('name','desc')->where('parent_id',$category->id)->get();

					foreach ($sub_category as $sub) {
						if (File::exists('images/categories/'.$sub->image)) {
						File::delete('images/categories/'.$sub->image);
				}
						$delete = $sub->delete();
					}
				}

				//delete cat image
				if (File::exists('images/categories/'.$category->image)) {
					File::delete('images/categories/'.$category->image);
				}

				$delete = $category->delete();
			}

			if($delete){
	        	$notification = array(
	            'message'=>'Successfully deleted',
	            'alert-type'=>'success'
	            );
	            return Redirect()->route('admin.categories')->with($notification);
	        } else{
	            $notification = array(
	            'message'=>'Something went wrong!!',
	            'alert-type'=>'error'
	            );
	         return Redirect()->route('admin.categories')->with($notification);
	        }
		}

}
