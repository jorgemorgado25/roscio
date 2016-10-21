@extends('app')

@section('html_title')
    Página no encontrada
@endsection



@section('$contentheader_description')
@endsection

@section('main-content')

<div class="error-page">
    <h2 class="headline text-yellow"> 404</h2>
    <div class="error-content">
        <h3><i class="fa fa-warning text-yellow"></i> Oops! La página solicitada no existe.</h3>
        <p>
            Por favor, verifique la url solicitada o consulte con el administrador del sistema.
        </p>
        
    </div><!-- /.error-content -->
</div><!-- /.error-page -->
@endsection