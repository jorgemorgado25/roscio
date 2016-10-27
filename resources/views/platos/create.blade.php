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
							<label for="">Gramos x 10 personas</label>
							<input type="text" class="form-control" maxlength="4" v-model="gramos">
						</div>
						<div class="col-md-12">
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
							<p v-if="error" class="alert alert-danger text-center">@{{ error }}</p>
							<hr>					
							
						</div>
						<div class="col-md-12">
							<div v-if="ingredientes.length == 0" class="alert alert-info text-center" role="alert">Añada ingredientes al plato</div>
							<table v-if="ingredientes.length > 0" class="table table-bordered">
								<tr>
									<th>Rubro</th>
									<th>Gramos</th>
									<th width="80px">Acción</th>
								</tr>								
								<tr v-for="ingrediente in ingredientes">
									<td>@{{ ingrediente.nombre }}</td>
									<td>@{{ ingrediente.gramos }}</td>
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
							<button class="btn" type="button" @click="test()">test</button>
						</div>
					</div><!-- box header -->
				</div><!-- div row -->

				<div class="box-body">
					{{ csrf_field() }}
					<button :disabled="inProcess" class="btn btn-primary" type="submit" id="btn-submit"><span class="glyphicon glyphicon-floppy-disk"></span> Registrar Plato</button>
				</div>
			</form>
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
			categoria_plato_id: '',
			categoria_rubro_id: '',
			rubros: '',
			rubro_id: '',
			gramos: '',
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
					console.log(response.data.rubros);
					this.rubros = response.data.rubros;
					response.data.rubros ? this.error = '' : this.error = 'No hay rubros en la categoría seleccionada';
				});
			},
			addIngrediente: function()
			{
				console.log(this.ingredientes.length);
				this.error = '';
				nombre = this.getRubroName(this.rubro_id);
				this.ingredientes.push({
					rubro_id: this.rubro_id, 
					nombre: nombre,
					gramos: this.gramos
				});
				this.rubro_id = '',
				this.gramos = ''

			},
			test: function(){
				console.log(this.ingredientes[0]['rubro_id']);
			},
			removeIngrediente: function(ingrediente){				
				this.ingredientes.$remove(ingrediente);
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
				if(this.categoria_rubro_id && this.rubro_id && this.gramos){
					return false;
				}else{
					return true;
				}				
			},
			savePlato: function()
			{
				//window.location = '/platos';
				if(this.ingredientes.length <= 1){
					this.error = "Debe seleccionar al menos dos ingredientes para el plato";
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