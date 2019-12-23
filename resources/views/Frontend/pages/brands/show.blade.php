@extends('frontend.layouts.master')
@section('content')
{{-- Side Bar Start --}}
<div class="container margin-top-20">
	<div class="row">
		
		@include('frontend.partials.product-sidebar')
		
		<div class="col-md-9">
			<div class="widget">
				<h3>All Products in <span class="badge badge-info">{{$brand->name}}</span></h3>
				@if (count($products)>0)
					@include('frontend.pages.product.partials.all_products')
				@else
					<div class="alert alert-warning">
						No Product available of this brand
					</div>
				@endif				
				
			</div>
		</div>
		<div class="col-md-9">
			<div class="widget">
				
			</div>
		</div>
	</div>
</div>
@endsection


		



