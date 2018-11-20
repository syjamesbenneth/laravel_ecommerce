@extends("layouts.sampletemplate")
@section("title","orderdetails")
@section("content")
<div class="container">
	<div class="row"style="margin-top: 100px;">
		<div class="col-lg-8 offset-lg-2">
			<table class="table table-striped">
				<thead>
					<tr>
						<th>Order</th>
						<th>Total</th>
						<th>Details</th>
					</tr>
				</thead>
				<tbody>
					@foreach($orders as $order)
					<tr>
						<td>{{$order->created_at->diffForHumans()}}</td>
						<td>{{ number_format($order->total,2,".",".") }}</td>
						<td>
							@foreach($order->items as $item)
								{{ $item->name }}:{{ $item->pivot->quantity }}
								@if($item->trashed())
								{{ $item->name }}: Item out of stock 
								<a href="/restoreItem/{{$item->id}}" class="btn btn-primary"> Restore Item
								</a>
								@endif
								<br>
							@endforeach
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
@endsection