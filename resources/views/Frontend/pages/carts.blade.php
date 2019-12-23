@extends('frontend.layouts.master')

@section('content')

<div class="container margin-top-20">
    <h2>My Cart Items</h2>

    @if (App\Models\Cart::totalItems() >0)
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>No.</th>
                <th>Product Title</th>
                <th>Product Image</th>
                <th>Product Quantity</th>               
                <th>Unit Price</th>             
                <th>Sub Total Price</th>            
                <th>Delete</th>             

            </tr>
        </thead>
        <tbody>
            @php
                $total_price = 0;
            @endphp
            @foreach (App\Models\Cart::wholeCart() as $cart)
                <tr>
                <td>{{$loop->index + 1}}</td>
                <td>
                    <a href="{{ route('products.show',$cart->product->slug) }}">{{$cart->product->title}}</a>
                </td>
                <td>
                    @if ($cart->product->images->count()>0)
                        <img src="{{ asset('images/products/'.$cart->product->images->first()->image) }}" width="60px"alt="">
                    @endif
                </td>
                <td>
                    <form class="form-inline" action="{{ route('carts.update',$cart->id) }}" method="post">
                        @csrf
                        <input type="number" value="{{$cart->product_quantity}}" name="product_quantity" class="form-control" required>
                        <button class="btn btn-success ml-1"> Update</button>
                    </form>
                </td>
                <td>
                    {{$cart->product->price}} Taka
                </td>
                <td>
                    @php
                        $total_price+=$cart->product->price * $cart->product_quantity;
                    @endphp
                    {{$cart->product->price * $cart->product_quantity}} Taka 
                </td>
                <td>
                    <form class="form-inline" action="{{ route('carts.delete',$cart->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="cart_id" >
                        <button class="btn btn-danger"> Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4"></td>
                <td>
                    Total Amount:
                </td>
                <td colspan="2">
                     <strong>{{$total_price}}</strong>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="float-right">
        <a href="{{ route('products.index') }}" class="btn btn-info"> Continue shopping.....</a>
        <a href="{{ route('checkouts') }}" class="btn btn-warning"> Checkout</a>
    </div>
    <div class="clearfix"></div>
    @else
        <div class="alert alert-warning">
            <strong>There is no item in your cart.</strong>
            <br>
            <a href="{{ route('products.index') }}" class="btn btn-info btn-lg">Continue Shopping...</a>
        </div>
    @endif
    
</div>
@endsection

