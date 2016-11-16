@extends('app')
@section('title')
	Listado de Matricula
@endsection
@section('main-content')
<div class="col-md-12">
	<h3>Crear Matrícula</h3><br>
	@include('partials.error-message')
	<div class="box box-primary">
		<div class="box-header with-border">
			<div class="row">
				
			</div>		
		</div>
		<div class="box-body with-border">			
			<form action="{{ route('matricula.store') }}" method="POST" id="form-create"  enctype="multipart/form-data">
				<input type="file" name="excel" id="excel" @change="inputFileChange">
				{{ csrf_field() }}
				<button class="btn-btn-primary">Examinar Matrícula</button>
			</form>
			
		</div>
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