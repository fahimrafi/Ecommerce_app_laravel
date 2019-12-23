	<div class="row">
		@foreach ($products as $product)
			<div class="col-md-4">
				<div class="card" >
					{{-- <img src=" {{ asset('images/products/'.'samsung.jpg') }} " class="card-img-top" alt="..."> --}}
					@php $i=1;	@endphp
					@foreach($product->images as $image)
						@if($i>0)
							<a href="{!! route('products.show',$product->slug) !!}">
							<img src=" {{ asset('images/products/'.$image->image) }} " class="card-img-top feature-img" alt="{{$product->title}}" >
						</a>
						@endif
						@php $i--;	@endphp
					@endforeach
					<div class="card-body">
						<h4 class="card-title">
						<a href="{{route('products.show',$product->slug) }}" > {{$product->title}}</a>
						</h4>
						<p class="card-text">{{$product->price}}</p>
						@include('frontend.pages.product.partials.cart-button')
					</div>
				</div>
			</div>
		@endforeach
		
	</div>
	{{-- Pagination --}}
	{{-- <div class="mt-4 pagination">
		{{ $products->links() }}
	</div> --}}