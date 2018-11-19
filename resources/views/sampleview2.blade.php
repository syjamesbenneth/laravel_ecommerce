<ul>
	@guest
	<li>
		<a href="{{route('login')}}">Login</a>
	</li>
	<li>
		<a href="{{route('register')}}">Register</a>
	</li>
	@else
		<h1>{{Auth::user()->name}}</h1>
		<form action="{{ route("logout")}}" method="POST">
			{{csrf_field()}}
			<button type="submit">Logout</button>
		</form>
	@endguest
</ul>