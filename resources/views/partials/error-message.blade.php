@if (Session::has('error-message'))
    <p class="alert alert-danger text-center">{{ Session::get('error-message') }}</p>
@endif