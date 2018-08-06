@extends('layouts.app')
@section('content')
	<div class="login">
		<div class="login-header">
			<h1>Login</h1>
		</div>
		@if (session('status'))
		 <ul>
		     <li class="text-danger"> {{ session('status') }}</li>
		 </ul>
		@endif
		@if ( Session::has('error') )
			<div class="alert alert-danger alert-dismissible" role="alert">
				<strong>{{ Session::get('error') }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
			</div>
		@endif
		<form class="login-form" action="{{ URL('login')}}" method="POST">
			{{ csrf_field() }}
			<h3>Username:</h3>
			<input type="text" placeholder="Username" name="username"/><br>
			<h3>Password:</h3>
			<input type="password" placeholder="Password" name="password"/>
			<br>
			<input type="checkbox" class="form-check-input" value="true" name="remember">Remember me
			<br>
			<button type="submit" class="login-button btn-primary">Login</button>
			<br>
			<a href="" class="sign-up">Sign Up!</a>
			<br>
		</form>
		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
	</div>
@endsection