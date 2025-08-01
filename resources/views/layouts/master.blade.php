<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  @PwaHead
  <title>SIMBA - Sistem Informasi & Monitoring Domba</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet" />

  <!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet" />

  <link rel="icon" href="{{ asset('sheep.ico') }}" type="image/x-icon">
  @stack('tambahan')
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
          <img src="{{ asset('domba.png') }}" alt="Logo" style="height: 50px; width: auto;" class="img-fluid">
        </div>
        <div class="sidebar-brand-text mx-2">SIMBA</div>
      </a>
      <div class="text-center text-white mb-4" style="font-size:10px">Sistem Informasi & Monitoring Domba
      </div>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

      <!-- Nav Item - Dashboard -->
      <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
        <a class="nav-link" href="/">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">Feature</div>

      <li class="nav-item {{ request()->is('domba') || request()->is('domba/*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('domba.index')}}">
          <i class="fas fa-fw fa-horse"></i>
          <span>Domba</span></a>
      </li>

      <li class="nav-item {{ request()->is('kandang') || request()->is('kandang/*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('kandang.index')}}">
          <i class="fas fa-fw fa-igloo"></i>
          <span>Kandang</span></a>
      </li>

      <li class="nav-item {{ request()->is('breeding') || request()->is('breeding/*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('breeding.index')}}">
          <i class="fas fa-fw fa-baby"></i>
          <span>Breeding</span></a>
      </li>

      <li class="nav-item {{ request()->is('fattening') || request()->is('fattening/*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('fattening.index')}}">
          <i class="fas fa-fw fa-cookie"></i>
          <span>Fattening</span></a>
      </li>

      <li class="nav-item {{ request()->is('death') || request()->is('death/*') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('death.index')}}">
          <i class="fas fa-fw fa-skull-crossbones"></i>
          <span>Death</span></a>
      </li>

      <li
        class="nav-item {{ str(request()->path())->contains('category') || str(request()->path())->contains('category/*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
          aria-controls="collapseTwo">
          <i class="fas fa-fw fa-cog"></i>
          <span>Master Data</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Master Data:</h6>
            <a class="collapse-item" href="{{route('pan_category.index')}}">Kategori Pan</a>
            <a class="collapse-item" href="{{route('consentrate_category.index')}}">Kategori Konsentrat</a>
            <a class="collapse-item" href="{{route('child_category.index')}}">Kategori Anak</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block" />

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                aria-label="Search" aria-describedby="basic-addon2" />
              <div class="input-group-append">
                <button class="btn btn-success" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
        </nav>
        <!-- End of Topbar -->


        <!-- Begin Page Content -->
        @yield('content')
        <!-- End Page Content -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Made with Love &copy; By Rafi Ramadhana 2025</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

  {{--
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>


  <!-- Page level plugins -->
  <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('js/demo/chart-pie-demo.js') }}"></script> --}}

  @stack('javascript')
  @include('sweetalert::alert')

  @RegisterServiceWorkerScript
</body>

</html>