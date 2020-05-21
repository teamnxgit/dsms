<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('includes.head')
    </head>
    <body>
        <div id="app">
            <div class="d-flex" id="wrapper">
                <!-- Sidebar -->
                <div class="bg-dark border-right" id="sidebar-wrapper">
                    @include('includes.sidebar')
                </div>
                <!-- Page Content -->
                <div id="page-content-wrapper">
                    @yield('content')
                </div>
            </div>
            <div class="messages" style="position:absolute;right:10px;top:10px;">
                @include('includes.messages')
            </div>
        </div>
    </body>
    <script type="application/javascript">
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
</html>
