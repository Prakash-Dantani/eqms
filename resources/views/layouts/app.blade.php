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

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }} "></script>
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }} "></script>
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }} "></script>

</body>

</html>
