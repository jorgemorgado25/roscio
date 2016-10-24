@extends('app')
@section('title')
	Editar Rubro
@endsection
@section('main-content')
<h3>Editar Rubro</h3><br>
<div class="box box-primary">
	{!! Form::model($rubro, ['route' => ['rubros.update', $rubro], 'method' => 'PUT']) !!}
	<div class="box-header with-border">
	
		<div class="row">
		<div class="col-md-6">
				<div class="form-group">
					<label for="">Nombre del rubro</label>
					<input name="rubro" type="text" value="{{ $rubro->rubro }}" class="form-control" required>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Categoría</label>
					{!! Form::select('categoria_rubro_id', $categoria, $rubro->categoriaRubro->id, [
						'class' => 'form-control',
						'v-model'  => 'categoria_id',
						'required' => 'required']
					) !!}
				</div>
			</div>			
		</div>
	</div>
	<div class="box-body">
		{{ csrf_field() }}
		<button class="btn btn-primary" type="submit" id="btn-submit"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar Cambios</button>
	</div>
	</form>
</div>	
@endsection

@section('scripts')
	<script>
		vm = new Vue({
			el: 'body',
			data: {
				categoria_id: ''
			}
		});
	</script>
@endsection