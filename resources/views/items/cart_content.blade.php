@extends("layouts.sampletemplate")
@section("content")
<!DOCTYPE html>
<html>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<head>
	<title>My Cart</title>

</head>

	<h1>My Cart</h1>
	@if($item_cart != null)
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Items</th>
					<th>Quantity</th>
					<th>Price</th>
					<th>Subtotal</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($item_cart as $item)
					<tr>
						<td>{{$item -> name}}</td>
						<td>
							<form method="POST" action="/menu/mycart/{{$item->id}}/changeQty">
							{{ csrf_field }}
							{{ method_field("PATCH") }}
							<input type="number" name="new_qty" value="{{$item->quantity}}" min=1 class="form-control">
							<button type="submit" class="btn btn-primary">Update Quantity</button>
							</form>
						</td>
						<td>{{$item -> quantity}}</td>
						<td>{{$item -> price}}</td>
						<td>{{$item -> Subtotal}}</td>
						<td>
						<form method="POST" action="/menu/mycart/{{$item->id}}/delete">
						{{ csrf_field() }}
						{{ method_field("DELETE") }}
						<button type="submit" class="btn btn-danger">Remove from Cart</button>
						</form>
						</td>
					</tr>
					@endforeach
					<tr>
						<td>Total: {{ $total }}</td>
					</tr>
			</tbody>
		</table>
		<a href="/menu/clearcart" class="btn btn-danger">Clear Cart</a>
	@else
		<h2>Cart is empty.</h2>
	@endif
		<a href="/catalog" class="btn btn-primary">Go back to shopping</a>
<body>

</body>


<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
@endsection
</html>