<?php
namespace App\Http\Controllers\Backend;
use App\Http\COntrollers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Image;
use DB;
use File;
use Auth;


class ProductsController extends Controller
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
        $products = Product::orderBy('id','desc')->get();
        return view('backend.pages.product.index')->with('products',$products);
}





public function create(){
    if (!Auth::user()->hasRole('admin')) 
            {
                return abort(401,"this action is not allowed");
            }
        return view('backend.pages.product.create');
}





public function edit($id){
    if (!Auth::user()->hasRole('admin')) 
            {
                return abort(401,"this action is not allowed");
            }
        $product = Product::find($id);
        return view('backend.pages.product.edit')->with('product',$product);
}



public function delete($id){
    if (!Auth::user()->hasRole('admin')) 
            {
                return abort(401,"this action is not allowed");
            }
        
        
        $product_imgs = ProductImage::where('product_id', $id)->get();         

               
        foreach ($product_imgs as $product_imgs) {
            if (File::exists('images/products/'.$product_imgs->images)) {
                
                File::delete('images/products/'.$product_imgs->images);         
            }
            $product_imgs->delete();
        }

        $product = Product::find($id);
        $delete= $product->delete();


        if($delete){
            
            $notification = array(
            'message'=>'Successfully deleted',
            'alert-type'=>'success'
            );
            return Redirect()->route('admin.products')->with($notification);
        } else{
            $notification = array(
            'message'=>'Something went wrong!!',
            'alert-type'=>'error'
            );
         return Redirect()->route('admin.products')->with($notification);
        }
        
        }



public function store(Request $request){
    if (!Auth::user()->hasRole('admin')) 
            {
                return abort(401,"this action is not allowed");
            }
        //data validation
            
        $validatedData = $request->validate([
        'title' => 'required|max:150',
        'description' => 'required',
        'price' => 'required|numeric',
        'quantity' => 'required|numeric',
        'category_id' => 'required|numeric',
        

        ]);
        
        //insert product code starts
        $product = new Product;
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id ;   
        $product->admin_id = 1 ;   
        $product->status = 1;
        $product->slug = str_slug($request->title);
        $product->save();

        
        //ProductImage Model Insert Image(for multiple files start)
        if(count($request->product_image)>0){
            foreach($request->product_image as $image){
                $img = str_random(6).date('his').time() . '.' . $image->getClientOriginalExtension();
                $location = 'images/products/' .$img;
                Image::make($image)->save($location);
                $product_image = new ProductImage;
                $product_image->product_id = $product->id;
                $product_image->image = $img;
                $product_image->save();
            }
        }
        //ProductImage Model Insert Image(for multiple files ends)
        return redirect()->route('admin.products');
}




public function update(Request $request,$id){
    if (!Auth::user()->hasRole('admin')) 
            {
                return abort(401,"this action is not allowed");
            }
        //data validation
        $validatedData = $request->validate([
        'title' => 'required|max:150',
        'description' => 'required',
        'price' => 'required|numeric',
        'quantity' => 'required|numeric',
        'category_id' => 'required|numeric',
        

        ]);
        //insert product code starts
        $product = Product::find($id);
        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id ;
        
        $product->slug = str_slug($request->title);
        $product->save();
         if(count($request->product_image)>0){
            $product_imgs = ProductImage::where('product_id', $id);
            $product_imgs->delete();
            foreach($request->product_image as $image){
                $img = str_random(6).date('his').time() . '.' . $image->getClientOriginalExtension();
                $location = 'images/products/' .$img;
                Image::make($image)->save($location);
                $product_image = new ProductImage;
                $product_image->product_id = $product->id;
                $product_image->image = $img;
                $product_image->save();
            }
        }
        return redirect()->route('admin.products');
    }
    
}