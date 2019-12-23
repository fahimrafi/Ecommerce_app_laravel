<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Auth;
use PDF;
class OrdersController extends Controller
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
		$orders = Order::orderBy('id','desc')->get();
	return view('backend.pages.orders.index',compact('orders'));
	}
	
	public function show($id){		
		if (!Auth::user()->hasRole('admin'))
			{
			return abort(401,"this action is not allowed");
			}
		$order = Order::find($id);
		$order->is_seen_by_admin = 1;
   		 $order->save();
	return view('backend.pages.orders.show',compact('order'));
	}
	
	public function delete($id){
		if (!Auth::user()->hasRole('admin'))
	{
	return abort(401,"this action is not allowed");
	}
		$order = Order::find($id);
		$order->delete();
	return back();
	}
	public function completed($id)
	{
			if (!Auth::user()->hasRole('admin'))
			{
			return abort(401,"this action is not allowed");
			}
			$order = Order::find($id);
			if ($order->is_completed) {
			$order->is_completed = 0;
			}
			else {
			$order->is_completed = 1;
			}
			$order->save();
			session()->flash('success', 'Order completed status changed ..!');
			return back();
	}


	public function chargeUpdate(Request $request, $id)
	{
			if (!Auth::user()->hasRole('admin'))
			{
			return abort(401,"this action is not allowed");
			}
		$order = Order::find($id);

		$order->shipping_charge = $request->shipping_charge;
		$order->custom_discount = $request->custom_discount;
		$order->save();

		session()->flash('success', 'Order charge and discount has changed ..!');
		return back();
	}



public function generateInvoice($id)
{
	if (!Auth::user()->hasRole('admin'))
	{
	return abort(401,"this action is not allowed");
	}

	$order = Order::find($id);
	// dd($order);
	
	 $pdf = PDF::loadView('backend.pages.orders.invoice', compact('order'));

	 return $pdf->stream('invoice.pdf');
	 return $pdf->download('invoice.pdf');
	//return view('backend.pages.orders.invoice', compact('order'));
}


public function paid($id)
{
	if (!Auth::user()->hasRole('admin'))
	{
	return abort(401,"this action is not allowed");
	}
	$order = Order::find($id);
	if ($order->is_paid) {
		$order->is_paid = 0;
	}
	else {
		$order->is_paid = 1;
	}
	$order->save();
	session()->flash('success', 'Order paid status changed ..!');
	return back();
}
	
}