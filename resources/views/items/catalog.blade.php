@extends("layouts.sampletemplate")
@section("content")
<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<head>
	<title>Catalog</title>
</head>
<body>
 
	<h1>Catalog Page</h1>
	<h2>Categories</h2>
	
	<a href="#" class="btn btn-primary">All</a>
	@foreach(\App\Category::all() as $category)
		<a href="/menu/categories/{{$category->id}}" class="btn btn-primary">{{ $category->name }}</a>
	@endforeach
<a href="menu/mycart" class="btn btn-info">Go to cart</a>
	<hr>
	<h2>Current Items: </h2>
	<a href="/menu/add" class="btn btn-primary">Add Item</a>
	@if(Session::has('success_message'))
		<span>{{ Session::get("success_message") }} </span>
	@endif
	@if(Session::has("success_cart"))
		<span>{{ Session::get("success_cart") }}</span>
	@endif
	<div class="container">
		<div class="row">
	@foreach($items as $indiv_item)
		<!-- <a href="/menu/{{ $indiv_item->id }}">{{ $indiv_item->name }}</a> -->
			<div class="col-lg-4">
				<div class="card">
					<img src="/{{$indiv_item->img_path}}" class="card-img-top m-auto" style="height:15rem" >
					<div class="card-body">
						<h5 class="card-title">{{$indiv_item->name}}</h5>
						<div class="form-group">
						<p>{{$indiv_item->price}}</p>
						</div>
						<div class="form-group">
						<p>{{$indiv_item->description}}</p>
						</div>
						<a href="/menu/{{$indiv_item->id}}">View Details</a>
						<!-- <div class="form-group"> -->
						<!-- <form method="POST" action="/addToCart/{{$indiv_item->id}}">
							{{ csrf_field() }}
							<div class="form-group">
								<input type="number" name="quantity" id="quantity" class="form-control">
								<button type="submit" class="btn btn-success"> Add to Cart</button> -->
								<input type="number" name="quantity" id="quantity_{{ $indiv_item->id }}" class="form-control">
								<button class="btn btn-success" onclick="addToCart({{$indiv_item->id}})"> Add to Cart</button>
						

						
					</div>
				</div>
			</div>
				@endforeach
			</div>
		</div>
	


</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript">
	function addToCart(id){
		let quantity = $("#quantity_"+id).val();
		// alert("Item ordered " + id + " Quantity ordered: " + quantity);
		$.ajax({
			"url": "/addToCart/"+id,
			"type":'POST',
			data:{
				'_token':'{{ csrf_token() }}',
				'quantity':quantity
			},
			"success": function(data){
				alert("Current number of items in cart: " + data);
			}
		});
	}
</script>
@endsection
</html>