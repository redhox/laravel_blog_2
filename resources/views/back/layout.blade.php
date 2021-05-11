<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@lang('Administration')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
  <!-- Theme style -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/css/adminlte.min.css" />
  @yield('css')
</head>

<style>
    .content-wrapper{
        background-color: rgb(48, 48, 48);
    }
    h1{
        color: white;
    }
    .card{
        background-color: rgb(236, 236, 236);
    }
    input{
        background-color: rgb(173, 173, 173);

    }
</style>

<body class="hold-transition sidebar-mini" style="color:white;">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand " style="background:rgb(32, 32, 32);border:transparent;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link">@lang('Show blog')</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('contacts.create') }}" class="nav-link">@lang('Contact')</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('profile') }}" class="nav-link">@lang('Profile')</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <form action="{{ route('logout') }}" method="POST" hidden>
          @csrf
        </form>
        <a class="nav-link"
            href="{{ route('logout') }}"
            onclick="event.preventDefault(); this.previousElementSibling.submit();">
            @lang('Logout')
        </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block" style="position: absolute;right:0;">
        <a href="{{ route('profile') }}"class="nav-link">{{ auth()->user()->name }}</a>
    </li>


    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background:rgb(32, 32, 32);">
    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          @foreach(config('menu') as $name => $elements)
              @if($elements['role'] === 'redac' || auth()->user()->isAdmin())
                  @isset($elements['children'])
                      <li class="nav-item has-treeview {{ menuOpen($elements['children']) }}">
                          <a href="#" class="nav-link {{ currentChildActive($elements['children']) }}">
                              <i class="nav-icon fas fa-{{ $elements['icon'] }}"></i>
                              <p>
                                  @lang($name)
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              @foreach($elements['children'] as $child)
                                  @if(($child['role'] === 'redac' || auth()->user()->isAdmin()) && $child['name'] !== 'fake')
                                      <x-back.menu-item
                                          :route="$child['route']"
                                          :sub=true>
                                          @lang($child['name'])
                                      </x-back.menu-item>
                                  @endif
                              @endforeach
                          </ul>
                      </li>
                  @else
                      <x-back.menu-item
                          :route="$elements['route']"
                          :icon="$elements['icon']">
                          @lang($name)
                      </x-back.menu-item>
                  @endisset
              @endif
          @endforeach





      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-light">@lang($title)</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        @yield('main')
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer" style="background:rgb(32, 32, 32);border-top:transparent;">
    <!-- Default to the left -->
    <strong>Copyright &copy; 2021 {{ config('app.name', 'Laravel') }}.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" ></script>
<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.0.5/js/adminlte.min.js"></script>
@yield('js')
</body>
</html>
