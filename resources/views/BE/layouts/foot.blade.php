
  <!-- plugins:js -->
  <script src="{{ asset('BE/vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('BE/vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('BE/vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('BE/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('BE/js/dataTables.select.min.js') }}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('BE/js/off-canvas.js') }}"></script>
  <script src="{{ asset('BE/js/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('BE/js/template.js') }}"></script>
  <script src="{{ asset('BE/js/settings.js') }}}}"></script>
  <script src="{{ asset('BE/js/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('BE/js/dashboard.js') }}"></script>
  <script src="{{ asset('BE/js/Chart.roundedBarCharts.js') }}"></script>
  <!-- End custom js for this page-->

@yield('script-BE')