@extends('app')
@section('title')
	Ver Plato
@endsection
@section('main-content')

<div class="row">
	<div class="col-md-12 ">
		<h3>Ver Plato</h3>
		
		<span>
			<a href="{{ route('platos.index') }}" class="btn btn-xs btn-default">&nbsp;
			<span class="glyphicon glyphicon-list"></span>
			Platos
		</a>&nbsp;
		<a href="{{ route('platos.create') }}" class="btn btn-xs btn-default">
			<span class="glyphicon glyphicon-plus"></span> Nuevo Plato
		</a>
		</span><br><br>
		@include('partials.success-message')
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 style="display:inline-block">@{{ old_plato }}</h3>&nbsp;
				<p style="display:inline-block" class="text-muted">@{{ categoria_plato }}</p>
				&nbsp;&nbsp;
				<button class="btn btn-xs btn-primary" @click="editPlato({{ $plato->id }})" v-if="!edit">
					<span class="glyphicon glyphicon-pencil"></span>
				</button>
				<div class="row" v-if="edit">
					<div class="col-md-5">
						<input type="text" class="form-control" v-model="new_plato">
					</div>
					<div class="col-md-5">
						{!! Form::select('categoria_rubro_id', $catPlatos, null, [
							'class' => 'form-control', 
							'required' => 'required', 
							'v-model' => 'new_categoria_plato_id'
						]) !!}
					</div>
					<div class="col-md-2">
						<button class="btn btn-xs btn-primary" @click="updatePlato()">
							<span class="glyphicon glyphicon-ok"></span>
						</button>
						<button class="btn btn-xs btn-danger" @click="cancelEdit()">
							<span class="glyphicon glyphicon-remove"></span>
						</button>
					</div>
				</div>				
			</div>
			<div class="box-body">
				<h4>Ingredientes</h4><br>
				<table class="table table-striped">
					<tr>
						<th>Rubro</th>
						<th>Categoría</th>
						<th>Medida</th>
						<th>Cantidad</th>
					</tr>					
					@foreach($plato->PlatoRubro as $platoRubro)
					<tr>
						<td>{{ $platoRubro->rubro->rubro }}</td>
						<td width="40%">{{ $platoRubro->rubro->categoriaRubro->categoria }}</td>
						<td width="20%">{{ $platoRubro->medida }}</td>		
						<td width="20%">{{ $platoRubro->cantidad }}</td>						
					</tr>
					@endforeach
				</table>
			</div>
			<div class="box-footer">
				<a href="{{ route('platos.edit', $plato->id) }}" class="btn btn-primary  pull-right"><span class="glyphicon glyphicon-pencil"></span> &nbsp;Editar</a>
			</div>
		</div><!-- box primary -->		
	</div>
</div>
@endsection

@section('scripts')
	<script src="{{ asset('/js/vue-functions.js') }}"></script>
	<script>
	vm = new Funciones({
		el: 'body',
		data:
		{
			edit: false,
			old_plato: '',
			new_plato: '',
			categoria_plato: '',
			new_categoria_plato_id: '',
			old_categoria_plato_id: '',
			plato_id: ''
		},
		created: function()
		{
			this.findPlato({{ $plato->id }});
		},
		methods:
		{
			editPlato: function()
			{
				this.edit = true;
			},
			cancelEdit: function(){
				this.edit = false;
				this.new_plato = this.old_plato;
				this.new_categoria_plato_id = this.old_categoria_plato_id;
			},
			findPlato: function(id)
			{
				this.getPlato(id).then(function(response)
				{
					this.categoria_plato = response.data.categoria_plato;
					this.old_plato = response.data.plato.plato;
					this.new_plato = response.data.plato.plato;
					this.new_categoria_plato_id = response.data.plato.categoria_plato_id;
					this.old_categoria_plato_id = response.data.plato.categoria_plato_id;
					this.plato_id = response.data.plato.id;
				});
			},
			updatePlato: function()
			{
				data = {
					id: this.plato_id,
					plato: this.new_plato,
					categoria_plato_id: this.new_categoria_plato_id
				},
				console.log(data);
				this.$http.post('/platos/updatePlato/', data)
				.then(function(response)
				{
					if (response.data.updated)
					{
						this.edit = false;
						this.findPlato(response.data.plato.id);
					}
				});
			}
		}
	});
	</script>
@endsection