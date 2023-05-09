@include('flash::message')
@if(count($errors->all()))
	<div class="alert alert-danger w-full">
		<ul class=" mb-0">
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>
@endif