@extends('app')

@section('title')
    Ingresos por Rango de Fecha
@endsection

@section('assets')
    <!-- Begin Chart -->
    {!! Charts::assets() !!}
    <!-- End Chart -->
@endsection

@section('main-content')
    <h3>Total Ingresos por Mes</h3>
    <br> 
    
    <div class="box box-primary">       
        <div class="box-header with-border">
            <div class="row">
            <div class="col-md-6">
                <label for="">Mes</label>
                <p>{{ $mes }}</p>
            </div>
            <div class="col-md-6">
                <label for="">Año</label>
                <p>{{ $ano }}</p>
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
