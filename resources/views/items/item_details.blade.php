<!DOCTYPE html>
<html>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">




<head>
	<title>Item Details</title>
</head>
<body>
	<h1>Item Details Page</h1>
	@if(Session::has("edit_message"))
		<span>{{ Session::get("edit_message") }}</span>
	@endif
	<img src="/{{ $items->img_path}}" width="300px" height="300px">
	<p>{{ $items->name }}</p>
	<p>{{ $items->description }}</p>
	<p>{{ $items->price }}</p>
	<a href="/menu/{{$items->id}}/edit" class="btn btn-primary">Edit</a>

	<button class="btn btn-danger" data-toggle="modal" data-target="#confirmDelete">Delete</button>

	<div id="confirmDelete" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4>Confirm Delete</h4>
				</div>
				<div class="modal-body">
					<p>Do you want to delete item?</p>
				</div>
				<div class="modal-footer">
					<form method="POST" action="/menu/{{ $items->id }}/delete">
					{{ csrf_field() }}
					{{ method_field("DELETE") }}
					<button type="submit" class="btn btn-primary">Confirm</button>
					</form>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
					<h4>Confirm Delete</h4>
				</div>
			</div>
		</div>		
	</div>

</body>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</html>