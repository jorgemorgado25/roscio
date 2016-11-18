@extends('app')
@section('title')
	Listado de Matricula
@endsection
@section('main-content')
<div class="col-md-12">
	<h3>Cargar Matrícula</h3><br>
	@include('partials.error-message')
	<div class="box box-primary">
		<div class="box-header with-border">
			Seleccione un archivo
		</div>
		<form action="{{ route('matricula.store') }}" method="POST" id="form-create"  enctype="multipart/form-data">
		<div class="box-body with-border">
			<div class="row">
				<div class="col-md-3">
					<b>Escolaridad: </b> {{ $escolaridad->escolaridad }}
				</div>
				<div class="col-md-3">
					<b>Mención: </b> {{ $mencion->mencion }}
				</div>
				<div class="col-md-3">
					<b>Año: </b> {{ $ano->ano }}
				</div>
				<div class="col-md-3">
					<b>Sección: </b> {{ $seccion->seccion }}
				</div>		
				<br><br>
				<div class="col-md-12">
					<input type="file" name="excel" id="excel" @change="inputFileChange">
				</div>				
				{{ csrf_field() }}
			</div>			
		</div>
		<div class="box-footer">
			<button class="btn btn-primary"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Matrícula</button>
		</div>
		</form>
	</div>	
</div>
@endsection

@section('scripts')
<script src="{{ asset('/js/vue-functions.js') }}"></script>
<script>
	vm = new Funciones({
		el: 'body',
		data: {
			excel: ''
		},
		methods: {
			inputFileChange: function(event)
			{
				// We will call this event each time the file upload input changes. This will push the data to our data property above so we can use the data on form submission.
				console.log('File');
				var files = this.excel.files;
				var data = new FormData();
				// for single file
				data.append('excel', files);
				this.$http.post('/matricula/postSendExcel/', this.excel)
				.then(function(response)
				{
					console.log('response');
				});

				//this.excel = event.target.files || event.dataTransfer.files;
			},
			enviar: function()
			{
				console.log('enviar');
				this.$http.post('/matricula/postSendExcel/', this.excel)
				.then(function(response)
				{
					console.log('response');
				});
			}
		}
	});
</script>
@endsection