<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Bayu Fajariyanto">
  
  <title>BOOKSTORE 2022 | {{ auth()->user()->role }}</title>

  
  <!-- Custom fonts for this template-->
  <link href="{{ asset('/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <!-- Custom styles for this template-->
  <link href="{{ asset('/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/ui/css/utilities.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
  
  <link rel="icon" type="image/x-icon" href="{{ asset('/img/posyandu/logo.ico') }}" />
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- sidebar -->
    @include('admin.partials.sidebar')
    <!-- sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content" class="bg-light color-dark">
        
        <!-- top-navbar -->
        @include('admin.partials.top-navbar')
        <!-- top-navbar -->

        @yield('content')

      </div>
      <!-- End of Main Content -->
      
      <!-- footer -->
      @include('admin.partials.footer')
      <!-- footer -->
      

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Scroll to Top Button-->
  
  <!-- Modal-->
  @include('admin.partials.logout')
  <!-- Modal-->
  

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  
  <script src="{{ asset('/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  {{-- <script src="{{ asset('/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('/js/demo/chart-pie-demo.js') }}"></script> --}}
  <script src="{{ asset('/ui/js/datatables-demo.js') }}"></script>

</body>

</html>
