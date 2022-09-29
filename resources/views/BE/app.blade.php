<!DOCTYPE html>
<html lang="en">

<head>
  @include('BE.layouts.head')
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('BE.layouts.navbar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      @include('BE.layouts.setting')
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      @include('BE.layouts.sidebar')
      <!-- partial -->
      @yield('content-BE')
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  @include('BE.layouts.foot')

</body>

</html>

