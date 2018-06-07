<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col menu_fixed">
                <div class="left_col scroll-view">
                    @include('admin.layouts.partials.sidebar')
                </div>
            </div>

            @include('admin.layouts.partials.navbar')

            <div class="right_col" role="main">
                @yield('content')
            </div>


        </div>
    </div>
</body>