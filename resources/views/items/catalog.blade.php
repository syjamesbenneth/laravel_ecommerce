<!DOCTYPE html>
<html>
<head>
	<title>Catalog</title>
</head>
<body>
	<h1>Catalog Page</h1>
	<h2>Categories</h2>
	@foreach(\App\Category:all() as $category)
		<a href="#">{{ $category->name }}</a>
	@endforeach

	<hr>
	<h2>Current Items: </h2>
	@foreach($items as $indiv_item)
		<a href="#">{{ $item->name }}</a>
	@endforeach
</body>
</html>