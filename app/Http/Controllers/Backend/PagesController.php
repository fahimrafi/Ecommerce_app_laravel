<?php
namespace App\Http\Controllers\Backend;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use Image;
use DB;
use App\Http\Controllers\Controller;
use Auth;


class PagesController extends Controller
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
	    return view('backend.pages.index');
	}

	
    
}