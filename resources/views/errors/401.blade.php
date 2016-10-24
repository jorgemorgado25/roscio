@extends('app')

@section('html_title')
    Área restringida
@endsection

@section('contentheader_title')
    401 Error Page
@endsection

@section('$contentheader_description')
@endsection

@section('main-content')

<div class="error-page">
    <h2 class="headline text-yellow"> 401</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Área restringida</h3>
        <p>Usted no posee los privilegios necesarios para acceder a la url solicitada.</p>

        <p>Por favor, consulte con el administrador del sistema.</p>       
    </div><!-- /.error-content -->
</div><!-- /.error-page -->
@endsection