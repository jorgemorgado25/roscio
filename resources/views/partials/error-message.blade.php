@if (Session::has('error-message'))
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    	<p class="text-center">{{ Session::get('error-message') }}</p>
    </div>
@endif