@extends('app')
@section('html_title')
    Usuarios
@endsection 
@section('main-content')

<h3>
	<a href="{{ route('users.create') }}" class="btn btn-primary btn-sm pull-right"><span class="glyphicon glyphicon-plus"></span> Nuevo</a>
	Listado de Usuarios
</h3><br/>

@include('partials.success-message')
<div class="box box-primary">
	<div class="box-header with-border">
		Hay <span id="total-users">{{ count($users) }}</span> usuarios registrados
	</div>
	<div class="box-body">
		<table class="table table-bordered" id="table">
			<thead>
			<tr>
				<th>#</th>
				<th>Nombre y Apellido</th>
				<th>Login</th>
				<th>Activo</th>
				<th width="150px">Acciones</th>
			</tr>
			</thead>
			<tbody>
			@foreach($users as $user)
				<tr id = "td-{{ $user->id }}">
					<td>{{ $user->id }}</td>
					<td id = "td-name-{{ $user->id }}">{{ $user->full_name }}</td>
					<td>{{ $user->login }}</td>

					<td>
						@if($user->active)
							<span class="label label-success">{{ $user->is_active }}</span>
						@else
							<span class="label label-warning">{{ $user->is_active }}</span>
						@endif
					</td>
						
					<td>
						<a title="Editar" href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-pencil"></span></a>

						<a href="{{ route('user.pdf', $user->id) }}" class="btn btn-sm btn-default" title="Imprimir" target="_blank">
							<span class="glyphicon glyphicon-print"></span>
						</a>

						<button title="Eliminar" onclick="eliminar({{ $user->id }})" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></button>

					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</div>
	<div class="box-footer">
		
	</div>
	<input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
	{!! Form::open(['route' => ['users.destroy', ':user_id'], 'method' => 'DELETE', 'id' => 'frm-delete']) !!}
	</form>
</div>
@endsection

@section('scripts')
	<script src="{{ asset('/js/users-index.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/set-datatable.js') }}"></script>
@endsection