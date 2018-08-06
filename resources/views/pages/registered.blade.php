@extends('layouts.app')
@section('content')
	<div class="login">
		<div class="login-header">
			<h1>Registered</h1>
		</div>
		@if ( Session::has('error') )
			<div class="alert alert-danger alert-dismissible" role="alert">
				<strong>{{ Session::get('error') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
		@endif

		@if ( Session::has('success') )
			<div class="alert alert-danger alert-dismissible" role="alert">
				<strong>{{ Session::get('success') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
		@endif

		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<form class="login-form" action="{{ URL('registered')}}" method="POST">
			{{ csrf_field() }}
			<h3>Name:</h3>
			<input type="text" placeholder="Name" name="name"/>
			<h3>Bithday:</h3>
			<input type="date" placeholder="Bithday" name="birthday" />
			<h3>Phone:</h3>
			<input type="tel" placeholder="Phone" name="phone"/>
			<h3>Username:</h3>
			<input type="text" placeholder="Username" name="username"/><br>
			<h3>Password:</h3>
			<input type="password" placeholder="Password" name="password"/>
			<br>
			<button type="submit" class="login-button btn-primary">Sign Up</button>
			<br>
			<a href="" class="sign-up">Sign in!</a>
			<br>
		</form>
	</div>
@endsection