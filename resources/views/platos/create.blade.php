@extends('app')
@section('title')
	Crear Plato
@endsection
@section('main-content')

<div class="row">
	<div class="col-md-8 col-md-offset-2">

		<h3 class="text-center">Registrar Plato</h3><br>

		<div class="box box-primary">
			<form method="POST" @submit.prevent="savePlato">

				<div class="row">
					<div class="box-header with-border">	
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Nombre del Plato</label>
								<input name="rubro" type="text" class="form-control" v-model="nombrePlato" required>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Categoría</label>
								{!! Form::select('categoria_rubro_id', $catPlatos, null, [
									'class' => 'form-control', 
									'required' => 'required', 
									'v-model' => 'categoria_plato_id'
								]) !!}
							</div>
						</div>
						<div class="col-md-12">
							<hr>
							<h4>Añadir Ingredientes al Plato:</h4>
							<hr>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Categoría del Rubro</label>
								{!! Form::select('categoria_rubro_id', $catRubro, null, [
									'class' => 'form-control', 
									'v-model' => 'categoria_rubro_id',
									'@change' => 'getRubro()']) 
								!!}
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Rubro</label>
								<select name="" id="" class="form-control" v-model="rubro_id">
									<option v-for="rubro in rubros" value="@{{rubro.id}}">
										@{{ rubro.rubro }}
									</option>
								</select>
							</div>
						</div>
						<div class="col-md-4">
							<label for="">Gramos o Cantidad</label>
							<input type="text" class="form-control" maxlength="4" v-model="cantidad" id="txt-cantidad">

							<input type="radio" name="medida" value="gramos" v-model="medida"> Gramos x 10 Personas <br>
							<input type="radio" name="medida" value="cantidad" v-model="medida"> Cantidad por persona
						</div>
						<div class="col-md-12">
							<br>
							<span class="clearfix">
								<button 
									type="button" 
									class="btn btn-default btn-sm pull-right" 
									:disabled="enableAddButtom()"
									@click="addIngrediente()">
									<span class="glyphicon glyphicon-ok"></span>&nbsp;
									Añadir Ingrediente
								</button>
							</span>
							<br>
							<div v-if="error" onclick="emptyError()" class="alert alert-danger alert-dismissible">
								<button type="button" class="close" aria-hidden="true">&times;</button>
								<p class="text-center">@{{ error }}</p>
							</div>
							<hr>							
						</div>
						<div class="col-md-12">
							<div v-if="ingredientes.length == 0" class="alert alert-info text-center" role="alert">Añada ingredientes al plato</div>
							<table v-if="ingredientes.length > 0" class="table table-bordered">
								<tr>
									<th>Rubro</th>
									<th>Gramos o Cantidad</th>
									<th>Medida</th>
									<th width="80px">Acción</th>
								</tr>								
								<tr v-for="ingrediente in ingredientes">
									<td>@{{ ingrediente.nombre }}</td>
									<td>@{{ ingrediente.cantidad }}</td>
									<td>@{{ ingrediente.medida }}</td>
									<td>
										<button 
											type="button" 
											class="btn btn-danger btn-xs" 
											@click="removeIngrediente(ingrediente)">
											<span class="glyphicon glyphicon-remove"></span>
										</button>
									</td>
								</tr>
							</table>
						</div>
					</div><!-- box header -->
				</div><!-- div row -->

				<div class="box-body">
					{{ csrf_field() }}
					<button :disabled="inProcess" class="btn btn-primary" type="submit" id="btn-submit"><span class="glyphicon glyphicon-floppy-disk"></span> Registrar Plato</button>&nbsp;&nbsp;
					<i v-if="inProcess" class="fa fa-spinner fa-spin fa"></i>
				</div>
			</form>
		</div><!-- box primary -->
	</div>
</div>
@endsection

@section('scripts')
	<script src="{{ asset('/js/vue-functions.js') }}"></script>
	<script>
	/* -------- ALPHANUM INTEGER --------- */
	$('#txt-cantidad').numeric({
    	allowMinus   : false,
    	allowThouSep : false,
    	allowDecSep: false
    });

	function verifyItem(items, id)
	{
		for (i in items)
		{
			if(items[i].rubro_id == id)
			{
				return true;
			}
		}
		return false;		
	};

	function emptyError(){
		vm.error = '';
	};

	vm = new Funciones({
		el: 'body',
		data:
		{
			categoria_plato_id: '',
			categoria_rubro_id: '',
			rubros: '',
			rubro_id: '',
			cantidad: '',
			medida: '',
			error: '',
			nombreRubro: '',
			nombrePlato: '',
			ingredientes: [],
			inProcess: false
		},
		methods:
		{
			getRubro: function()
			{
				this.rubros = '';
				this.cargando = true;
				this.rubro_id = '',

				this.getRubros(this.categoria_rubro_id).then(function(response)
				{
					this.cargando = false;
					this.rubros = response.data.rubros;
					response.data.rubros ? this.error = '' : this.error = 'No hay rubros en la categoría seleccionada';
				});
			},
			addIngrediente: function()
			{
				this.error = '';
				nombre = this.getRubroName(this.rubro_id);
				if (verifyItem(this.ingredientes, this.rubro_id))
				{
					this.error = 'El ingrediente ' + nombre + ' ya está agregado';
				}else
				{
					this.ingredientes.push({
						rubro_id: this.rubro_id, 
						nombre: nombre,
						cantidad: this.cantidad,
						medida: this.medida
					});
					this.rubro_id = '',
					this.cantidad = '',
					this.medida = ''
				}
			},
			test: function(){
				console.log(this.ingredientes[0]['rubro_id']);
			},
			removeIngrediente: function(ingrediente)
			{				
				this.ingredientes.$remove(ingrediente);
				this.error = '';
			},
			getRubroName: function()
			{
				for (var i = 0; i < this.rubros.length; i++)
				{
					if (this.rubros[i].id == this.rubro_id)
					return this.rubros[i].rubro;
				}
				return '';
			},
			enableAddButtom: function()
			{
				if(this.categoria_rubro_id && this.rubro_id && this.cantidad && this.medida){
					return false;
				}else{
					return true;
				}				
			},
			savePlato: function()
			{
				//window.location = '/platos';
				if(this.ingredientes.length == 0){
					this.error = "Debe seleccionar un ingrediente para el plato";
				}else {
					data = {
						plato: this.nombrePlato, 
						categoria_plato_id: this.categoria_plato_id, 
						ingredientes: this.ingredientes
					};			
					this.inProcess = true;
					this.$http.post('/platos/postCreatePlato/', data)
					.then(function(response)
					{
						if(response.data.created) { 
							window.location = '/platos/' + response.data.plato_id;
						}
			        });
				}
			}
		}
	});
	</script>
@endsection