<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Menú Principal</li>

            <li @if(Request::segment(1)=='dashboard')class="active"@endif>
                <a href="{{ route('prueba.index') }}"><i class='glyphicon glyphicon-home'></i> <span>Panel de Administración</span></a>
            </li>

            @if(Auth::user()->hasRole('comedor'))                
                <li @if(Request::segment(1)=='comedor')class="active"@endif>
                    <a href="{{route('comedor.acceso')}}">
                        <i class="glyphicon glyphicon-log-in"></i>
                        <span>Acceso a Comedor</span>
                    </a>
                </li>
                <li @if(Request::segment(1)=='menu')class="active"@endif>
                    <a href="{{route('menu.index')}}">
                        <i class="glyphicon glyphicon-calendar"></i>
                        <span>Menú del Día</span>
                    </a>
                </li>            
            @endif         

            @if(Auth::user()->isAdmin)           
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
