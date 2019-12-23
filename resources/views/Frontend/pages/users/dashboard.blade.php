@extends('frontend.pages.users.layouts.master')

@section('sub-content')

<div class="container ">
    <h2>Welcome {{ $user->name}} </h2>
    

    <div class="row">
    	<div class="col-md-4">
    		<div class="card card-body mt-2 pointer" onclick="location.href='{{ route('user.profile') }}'">
    			<h3>Update Profile</h3>
    		</div>
    	</div>
    </div>
</div>
@endsection