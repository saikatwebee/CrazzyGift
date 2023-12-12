<!-- plugins:js -->
  <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('externalScript/dataTables.select.min.js') }}"></script>
   <!-- Include DataTables Buttons JavaScript -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ asset('externalScript/off-canvas.js') }}"></script>
  <script src="{{ asset('externalScript/hoverable-collapse.js') }}"></script>
  <script src="{{ asset('externalScript/template.js') }}"></script>
  <script src="{{ asset('externalScript/settings.js') }}"></script>
  <script src="{{ asset('externalScript/todolist.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ asset('externalScript/dashboard.js') }}"></script>
  <script src="{{ asset('externalScript/Chart.roundedBarCharts.js') }}"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.7.28/sweetalert2.min.js"
    integrity="sha512-CyYoxe9EczMRzqO/LsqGsDbTl3wBj9lvLh6BYtXzVXZegJ8VkrKE90fVZOk1BNq3/9pyg+wn+TR3AmDuRjjiRQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/js/bootstrap-select.min.js"></script>

  <!-- Datepicker -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>

toastr.options = {
    closeButton: true,
    debug: false,
    newestOnTop: false,
    progressBar: false,
    positionClass: "toast-top-center",
    preventDuplicates: false,
    onclick: null,
    showDuration: "2000",
    hideDuration: "2000",
    timeOut: "2000",
    extendedTimeOut: "2000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
};


function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

 document.addEventListener("DOMContentLoaded", function() {
        var loader = document.querySelector(".loader-container");
        setTimeout(() => {
            loader.style.display = "none";
        }, 1000);

    });

</script>
  <!-- End custom js for this page-->