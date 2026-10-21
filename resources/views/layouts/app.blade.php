<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EQMS</title>


  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.ico') }} ">

  <!-- Local Third-Party Libraries (100% Offline Compatible) -->
  <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }} ">
  <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }} ">
  <link rel="stylesheet" href="{{ asset('assets/libs/apexcharts/apexcharts.css') }} ">
  <link rel="stylesheet" href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }} ">

  <!-- Main Design System & Custom Stylesheet -->
  <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

<!-- DataTables Bootstrap 5 -->
<link href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<!-- Responsive DataTables -->
<link href="https://cdn.datatables.net/responsive/3.0.7/css/responsive.bootstrap5.min.css" rel="stylesheet">

</head>

<body>

    <!-- ==========================================
        START: Sidebar Component
        Highly polished, dark-green sticky navigation
    ========================================== -->


        <!-- Navigation Menu -->
            @include('layouts.sidebar')

        <!-- ==========================================
            END: Sidebar Component
        ========================================== -->

        <div class="main-wrapper">
            @include('layouts.navigation')

                {{ $slot }}
                <!-- END: Main Layout Grid -->


            <!-- START: Footer Component -->
                @include('layouts.footer')
            <!-- END: Footer Component -->

        </div>
    <!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Bootstrap Bundle (Includes Popper) -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script> -->
    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }} "></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>

<!-- DataTables Bootstrap 5 -->
<script src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.min.js"></script>

<!-- Responsive Extension -->
<script src="https://cdn.datatables.net/responsive/3.0.7/js/dataTables.responsive.min.js"></script>

<!-- Bootstrap 5 Responsive -->
<script src="https://cdn.datatables.net/responsive/3.0.7/js/responsive.bootstrap5.min.js"></script>

    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }} "></script>
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }} "></script>

</body>

</html>
