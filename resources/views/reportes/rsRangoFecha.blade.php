@extends('app')

@section('title')
    Ingresos por Rango de Fecha
@endsection

@section('assets')
    {!! Charts::assets() !!}
@endsection

@section('main-content')
    <h3>Total Ingresos por Rango de Fecha</h3>
    <br> 
    
    <div class="box box-primary">       
        <div class="box-header with-border">
            <div class="row">
            <div class="col-md-6">
                <label for="">Desde</label>
                <p>{{ $fecha1 }}</p>
            </div>
            <div class="col-md-6">
                <label for="">Hasta</label>
                <p>{{ $fecha2 }}</p>
            </div>
            <br>
            <div class="col-md-12">
                @if($total > 0)
                    <div class="panel panel-default">
                        <div class="panel-body text-center">
                            {!! $chart->render() !!}
                        </div>
                    </div>
                    
                @else
                    <div class="alert alert-danger text-center">No hay registros</div>
                @endif
            </div>
        </div>        
        </div>
    </div>

@endsection
