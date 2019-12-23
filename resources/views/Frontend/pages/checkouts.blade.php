@extends('frontend.layouts.master')
@section('content')
<div class="card card-body container margin-top-20">
    <div class="card card-body">
        <h2>Confirm Items</h2>
        <hr>
        
        <div class="row">
            <div class="col-md-7 border-right">
                @foreach (App\Models\Cart::wholeCart() as $cart)
                <p>
                    {{$cart->product->title}} -
                    <strong>{{$cart->product->price}} Taka</strong>
                    - {{$cart->product_quantity}} items
                </p>
                @endforeach
            </div>
            <div class="col-md-5">
                @php
                $total_price = 0;
                @endphp
                @foreach (App\Models\Cart::wholeCart() as $cart)
                @php
                $total_price += $cart->product->price * $cart->product_quantity;
                @endphp
                @endforeach
                <p>Total Price: <strong> {{$total_price}}</strong></p>
                <p>Total Price(including shipping cost): <strong> {{$total_price + App\Models\Setting::first()->shipping_cost}}</strong></p>
            </div>
        </div>
        <p>
            <a href="{{ route('carts') }}">Change Cart Items</a>
        </p>
        
    </div>
    <div class="card card-body mt-2">
        <h2>Shipping Address</h2>
        <form method="POST" action="{{ route('checkouts.store') }}">
            @csrf
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Receiver Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::check() ? Auth::user()->name : '' }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone No') }}</label>
                <div class="col-md-6">
                    <input id="phone_no" type="number" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{Auth::check() ? Auth::user()->phone_no : '' }}" required autocomplete="phone_no" autofocus>
                    @error('phone_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            
            
            
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::check() ? Auth::user()->email : ''  }}"  autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="shipping_address" class="col-md-4 col-form-label text-md-right">{{ __('Shipping Address') }}</label>
                <div class="col-md-6">
                    <textarea id="shipping_address"  class="form-control @error('shipping_address') is-invalid @enderror" name="shipping_address" rows="4"   autocomplete="shipping_address" autofocus >{{ Auth::check() ? Auth::user()->shipping_address : ''  }}</textarea>
                    @error('shipping_address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="shipping_address" class="col-md-4 col-form-label text-md-right">{{ __('Additional Request(Optional)') }}</label>
                <div class="col-md-6">
                    <textarea id="message"  class="form-control @error('message') is-invalid @enderror" name="message" rows="4"   autocomplete="message" autofocus ></textarea>
                    @error('message')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="payment_method" class="col-md-4 col-form-label text-md-right">{{ __('Payment Method') }}</label>
                <div class="col-md-6">
                    <select class="form-control" name="payment_method_id" id="payments" required>
                        <option value=""> Select a payment method please</option>
                        @foreach ($payments as $payment)
                        <option value="{{$payment->short_name}}"> {{$payment->name}}</option>
                        @endforeach
                    </select>
                    @foreach ($payments as $payment)
                    {{-- <div> --}}
                        
                        @if ($payment->short_name == "in_cash")
                        <div id="payment_{{$payment->short_name}}" class="alert alert-success text-center hidden">
                            <h3>
                            OK! Just finish order.
                            <br>
                            <small>
                            You will get your product in 2 or 3 business days.
                            </small>
                            </h3>
                        </div>
                        @else
                        <div id="payment_{{$payment->short_name}}" class="alert alert-success text-center hidden">
                            <h3>
                            {{$payment->name}} Payment
                            </h3>
                            <p>
                                <strong> {{$payment->name}} No : {{$payment->no}}</strong>
                                <br>
                                <strong>Account Type: {{$payment->type}}</strong>
                            </p>
                            <div class="alert alert-success">
                                Please send <strong>{{ceil($total_price + $total_price * .0185)}}</strong> to this bkash No: (<strong>{{$payment->no}}</strong>) and give your transaction no below
                            </div>
                           
                        </div>
                        @endif
                    {{-- </div> --}}
                    @endforeach
                    <input type="text" name="transaction_id" id="transaction_id" class=" form-control hidden" placeholder="Enter transaction code">
                </div>
            </div>
            
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                    {{ __('Order Now') }}
                    </button>
                </div>
            </div>
        </form>
        <hr>
        
        
        
    </div>
</div>
@endsection
@section('scripts')
<script type="text/javascript">
    $("#payments").change(function(){


        switch($("#payments").val()) {
          case "in_cash":
            $("#payment_in_cash").removeClass('hidden');
            $("#payment_rocket").addClass('hidden');
            $("#payment_bkash").addClass('hidden');
            $("#transaction_id").addClass('hidden');
            
            break;

          case "bkash":
            $("#payment_bkash").removeClass('hidden');
            $("#payment_rocket").addClass('hidden');
            $("#payment_in_cash").addClass('hidden');
            $("#transaction_id").removeClass('hidden');
            break;  
          case "rocket":
            $("#payment_rocket").removeClass('hidden');
            $("#payment_bkash").addClass('hidden');
            $("#payment_in_cash").addClass('hidden');
            $("#transaction_id").removeClass('hidden');
            break;
          default:
            // code block
        }
      
        
        
})
</script>
@endsection


