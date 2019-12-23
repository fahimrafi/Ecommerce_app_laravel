<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;


class BrandsController extends Controller
{
   public function index()
    {
        //
    }

    
     
   
    

    
     
    public function show($id)
    {
        $brand = Brand::find($id);

        $products=$brand->products;
            
             return view('frontend.pages.brands.show',compact('brand','products'));
       

        
    }
}
