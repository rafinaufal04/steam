// Fungsi untuk menginisialisasi plugin
$(document).ready(function () {
  // jquery datatables
  $('#dataTable').DataTable();

  // tooltips
  $('[data-toggle="tooltip"]').tooltip();

  // datepicker
  $('.date-picker').datepicker({
    autoclose: true,
    todayHighlight: true
  });

  // jquery maskmoney
  // format currency, menambahkan tanda titik (.) saat entri data
  $('.mask_money').maskMoney({ thousands: '.', decimal: ',', precision: 0 });
});