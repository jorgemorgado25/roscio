<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Menú Principal</li>
            <!-- Optionally, you can add icons to the links -->

            <li @if(Request::segment(1)=='dashboard')class="active"@endif>
                <a href="{{ route('prueba.index') }}"><i class='glyphicon glyphicon-home'></i> <span>Inicio</span></a>
            </li>

            @if(Auth::user()->hasRole('inscripciones'))
            <li @if(Request::segment(1)=='estudiantes')class="active"@endif>
                <a href="#">
                    <i class="fa fa-child"></i>
                    <span>Estudiantes</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li @if(Request::segment(1)=='estudiantes' && Request::segment(2)== '')class="active"@endif>
                        <a href="{{ route('estudiantes.index') }}">
                            <span class="glyphicon glyphicon-list"></span>Listado</a>
                    </li>
                    <li @if(Request::segment(1)=='estudiantes' && Request::segment(2)=='create')class="active" @endif>
                        <a href="{{ route('estudiantes.create') }}"><span class="glyphicon glyphicon-plus"></span>Nuevo Estudiante</a>
                    </li>
                </ul>
            </li>           

            <li @if(Request::segment(1)=='inscripciones')class="active"@endif>
                <a href="#">
                    <i class="glyphicon glyphicon-star"></i>
                    <span>Inscripciones</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                     <li @if(Request::segment(1)=='inscripciones' && Request::segment(2)== '')class="active"@endif>
                        <a href="{{ route('inscripciones.index') }}">
                            <span class="glyphicon glyphicon-list"></span>Listado</a>
                    </li>
                    <li @if(Request::segment(1)=='inscripciones' && Request::segment(2)=='create')class="active" @endif>
                        <a href="{{ route('inscripciones.create') }}"><span class="glyphicon glyphicon-plus"></span>Realizar Inscripción</a>
                    </li>
                </ul>
            </li>
            @endif
            

            @if(Auth::user()->isAdmin)
            <li @if(Request::segment(1)=='escolaridades')class="active"@endif>
                <a href="#">
                    <i class="glyphicon glyphicon-flag"></i>
                    <span>Escolaridades</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li @if(Request::segment(1)=='users' && Request::segment(2)== '')class="active"@endif>
                        <a href="{{ route('escolaridades.index') }}">
                            <span class="glyphicon glyphicon-list"></span>Listado</a>
                    </li>
                    <li @if(Request::segment(1)=='users' && Request::segment(2)=='create')class="active"@endif>
                        <a href="{{ route('escolaridades.create') }}"><span class="glyphicon glyphicon-plus"></span>Nueva Escolaridad</a>
                    </li>
                </ul>
            </li>
            <li @if(Request::segment(1)=='users')class="active"@endif>
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Usuarios</span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li @if(Request::segment(1)=='users' && Request::segment(2)== '')class="active"@endif>
                        <a href="{{ route('users.index') }}">
                            <span class="glyphicon glyphicon-list"></span>Listado</a>
                    </li>
                    <li @if(Request::segment(1)=='users' && Request::segment(2)=='create')class="active"@endif>
                        <a href="{{ route('users.create') }}"><span class="glyphicon glyphicon-plus"></span>Nuevo Usuario</a>
                    </li>
                </ul>
            </li>
            @endif
            
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
