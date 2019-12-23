<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
       public function index()
    {
        //
    }

    
     
   
    

    
     
    public function show($id)
    {
        $category = Category::find($id);

        $products=$category->products;
            
             return view('frontend.pages.categories.show',compact('category','products'));
       

        
    }
   
   
    
   
}
