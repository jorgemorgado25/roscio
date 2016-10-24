@if (Session::has('success-message'))
	<div class="alert alert-success alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<p class="text-center">{{ Session::get('success-message') }}</p>
	</div>
@endif