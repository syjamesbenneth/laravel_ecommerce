<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


<head>
	<title>Edit Item Page</title>
</head>
<body>
	<h1>Edit Item Page</h1>
	<div class="container">
		<div class="row">
			@if(count($errors)>0)
				@foreach($errors->all() as $error)
					<p>{{$error}}</p>
				@endforeach
			@endif
		</div>
		<div class="row">
			<div class="col-lg-8 offset-lg-2">
				<form method="POST" action="/menu/{{ $item-> id}}/edit" enctype="multipart/form-data">
			{{ csrf_field() }}
			{{ method_field("PATCH") }}
			<div class="form-group">
				<label for="name">Name: </label>
				<input type="text" name="name" id="name" class="form-control" value="{{$item->name}}">
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea name="description" id="description" class="form-control">{{ $item->description}}</textarea>
			</div>
			<div class="form-group">
				<label for="price">Price: </label>
				<input type="number" name="price" id="price" step=0.01 min=0 value="{{$item->price}}" class="form-control">
			</div>
			<div class="form-group">
				<label for="image">Image:</label>
				<input type="file" name="image" id="image" class="form-control">
				<button type="submit" class="btn btn-primary">Edit Item</button>
			</div>
				</form>

			</div>
		</div>
	</div>
	
</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>