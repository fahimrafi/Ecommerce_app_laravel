@extends('frontend.layouts.master')
@section('content')
{{-- Side Bar Start --}}
<div class="container margin-top-20">
	<div class="row">
		@include('frontend.partials.product-sidebar')
		
		<div class="col-md-9">
			<div class="widget">
				<h3>Searched Products For -<span class="badge badge-primary"> {{$search}} </span></h3>
				@include('frontend.pages.product.partials.all_products')
			</div>
		</div>
		<div class="col-md-9">
			<div class="widget">
				
			</div>
		</div>
	</div>
</div>
@endsection


		



