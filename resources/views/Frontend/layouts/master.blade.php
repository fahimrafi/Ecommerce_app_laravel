<!doctype html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		@include('frontend.partials.styles')
		<title>
			@yield('title', 'LaraEcommerce')
		</title>
		<meta name="csrf-token" content="{{ csrf_token() }}">
	</head>
	<body>
		<div class="wrapper">
			{{-- Navigation --}}
			@include('frontend.partials.nav')
			
			{{-- Navigation Ends --}}

			@include('frontend.partials.messages')
			
			@yield('content')

			

			

			<!-- Optional JavaScript -->
			{{-- Fontawesome --}}
			@include('frontend.partials.scripts')
			@yield('scripts')
			@include('frontend.partials.footer')

		</div>
		</body>
	</html>