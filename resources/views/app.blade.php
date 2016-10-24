<!DOCTYPE html>
<html>

@include('partials.htmlheader')
@yield('css')
<body class="skin-blue sidebar-mini">
    <div class="wrapper">
        @include('partials.mainheader')
        @include('partials.sidebar')
        <div class="content-wrapper">
            <!--include('partials.contentheader')-->
            <section class="content">
                @yield('main-content')
            </section>
        </div>
        <!-- include('partials.controlsidebar') -->
        <!-- include('partials.footer') -->
    </div>
    @include('partials.scripts')
    @yield('scripts')
</body>
</html>