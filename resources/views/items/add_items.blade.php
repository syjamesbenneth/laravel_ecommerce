<!DOCTYPE html>
<html>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<head>

	<title>Add Item</title>
</head>
<body>
	<h1>Add new item</h1>
	<div class="container">
		<div class="row"> 
		<!-- function to show if there are errors -->
			@if(count($errors)>0)
				@foreach($errors->all() as $error)
				<p>{{ $error }}</p>
				@endforeach
			@endif
		</div>
	</div>
	<div class="container">
		<div class="row">

			<div class="col-lg-8 offset-lg-2">
				<form method="POST" action="/menu/add" enctype="multipart/form-data">
		{{ csrf_field() }}
		
		<div class="form-group">
			<label for="name">Name: </label>
			<input type="text" name="name" id="name" class="form-control"></input>
		</div>
		<div class="form-group">
			<label for="description">Description: </label>
			<textarea name="description" id="description" class="form-control"></textarea>
		</div>
		<div class="form-group">
			<label for="price">Price: </label>
			<input type="number" name="price" id="price" step="0.01" min=0 class="form-control">
		</div>
		<div class="form-group">
			<label for="image">Upload Image: </label>
			<input type="file" name="image" id="image" class="form-control">
		</div>
		<button type="submit" class="btn btn-success">Add New Item</button>
	</form>

			</div>
		</div>
	</div>
	
</body>
</html>