<!-- Input Mask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Bootstrap -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- Application Script -->
<script src="../../app/js/pages/ctvty.js"></script>
<script src="../../app/js/pages/ffcls.js"></script>
<script src="../../app/js/pages/stff.js"></script>
<script src="../../app/js/pages/prk.js"></script>
<script src="../../app/js/pages/prflng.js"></script>
<script src="../../app/js/dttbls.js"></script>
<script src="../../app/js/chckdsrnm.js"></script>
<script src="../../app/js/cstm.js"></script>
<!-- jQuery Mapael -->
<script src="../../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../../plugins/raphael/raphael.min.js"></script>
<script src="../../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../../plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<script type="text/javascript">

  function checkMain(x) {
    var checked = $(x).prop('checked');
    $('.cbxMain').prop('checked', checked)
    $('tr:visible').each(function () {
      $(this).find('.chk_delete').each(function () {
        this.checked = checked;
      });
    });
  }

  function success() {
    $('#autoclosable-btn-success').prop('disabled', true);
    $('.alert-autocloseable-success').show();
    $('.alert-autocloseable-success').delay(3000).fadeOut('slow', function () {
      // animation complete.
      $('#autoclosable-btn-success').prop('disabled', false);
    });
  }

  function save_success() {
    $('#autoclosable-btn-add').prop('disabled', true);
    $('.alert-autocloseable-add').show();
    $('.alert-autocloseable-add').delay(3000).fadeOut('slow', function () {
      // animation complete.
      $('#autoclosable-btn-add').prop('disabled', false);
    });
  }

  function deleted() {
    $('#autoclosable-btn-danger').prop('disabled', true);
    $('.alert-autocloseable-danger').show();
    $('.alert-autocloseable-danger').delay(3000).fadeOut('slow', function () {
      // animation complete.
      $('#autoclosable-btn-danger').prop('disabled', false);
    });
  }

  function duplicate() {
    $('#autoclosable-btn-duplicate').prop('disabled', true);
    $('.alert-autocloseable-duplicate').show();
    $('.alert-autocloseable-duplicate').delay(3000).fadeOut('slow', function () {
      // animation complete.
      $('#autoclosable-btn-duplicate').prop('disabled', false);
    });
  }

  function duplicateuser() {
    $('#autoclosable-btn-duplicateuser').prop('disabled', true);
    $('.alert-autocloseable-duplicateuser').show();
    $('.alert-autocloseable-duplicateuser').delay(3000).fadeOut('slow', function () {
      // animation complete.
      $('#autoclosable-btn-duplicateuser').prop('disabled', false);
    });
  }

  function filesize() {
    $('#autoclosable-btn-filesize').prop('disabled', true);
    $('.alert-autocloseable-filesize').show();
    $('.alert-autocloseable-filesize').delay(3000).fadeOut('slow', function () {
      // animation complete.
      $('#autoclosable-btn-filesize').prop('disabled', false);
    });
  }

  function blotter() {
    $('#autoclosable-btn-blotter').prop('disabled', true);
    $('.alert-autocloseable-blotter').show();
    $('.alert-autocloseable-blotter').delay(3000).fadeOut('slow', function () {
      // animation complete.
      $('#autoclosable-btn-blotter').prop('disabled', false);
    });
  }

  function lengthstay() {
    $('#autoclosable-btn-length').prop('disabled', true);
    $('.alert-autocloseable-length').show();
    $('.alert-autocloseable-length').delay(3000).fadeOut('slow', function () {
      // animation complete.
      $('#autoclosable-btn-length').prop('disabled', false);
    });
  }

  function end() {
    $('#autoclosable-btn-end').prop('disabled', true);
    $('.alert-autocloseable-end').show();
    $('.alert-autocloseable-end').delay(3000).fadeOut('slow', function () {
      // animation complete.
      $('#autoclosable-btn-end').prop('disabled', false);
    });
  }

  function start() {
    $('#autoclosable-btn-start').prop('disabled', true);
    $('.alert-autocloseable-start').show();
    $('.alert-autocloseable-start').delay(3000).fadeOut('slow', function () {
      // animation complete.
      $('#autoclosable-btn-start').prop('disabled', false);
    });
  }

  $(document).ready(function () {
    $('.chk_delete').click(function () {
      if ($('.chk_delete:checked').length == $('.chk_delete').length) {
        $('.cbxMain').prop('checked', true);
      }
      else {
        $('.cbxMain').prop('checked', false);
      }
      $('#check-all').click(function () {
        $("input:checkbox").attr('checked', true);
      });
    });
    $('.no-print').hide();
  });

  // initialize select2 elements
  $(".select2").select2();

  // initialize money euro
  $("[data-mask]").inputmask();
</script>