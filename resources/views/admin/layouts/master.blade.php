<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @include('admin.layouts.components.stylesheet')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo"
                height="60" width="60">
        </div>

        @include('admin.layouts.components.header')

        @include('admin.layouts.components.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <main class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    @if(session()->has('success'))
                    <div class="alert alert-success">
                        <strong>{{ session('success') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            <strong>{{ session('error') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        <h1 class="m-0">@yield('breadcrumb')</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                            <li class="breadcrumb-item active">@yield('breadcrumb')</li>
                        </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
      
            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @yield('contents')
                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </main>  

        @include('admin.layouts.components.footer')
    </div>
    <!-- ./wrapper -->

    @include('admin.layouts.components.script')
</body>

</html>
