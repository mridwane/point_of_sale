var table;
$(document).ready(function () {
  $(".datepicker")
    .datepicker({
      format: "yyyy-mm-dd",
      autoclose: true,
      immediateUpdates: true,
      todayBtn: true,
      todayHighlight: true,
    })
    .datepicker("setDate", "now");

  //pemanggilan fungsi tampil Data Transaksi.

  table = $("#tableListTransaksi").DataTable({
    processing: true,
    serverSide: true,
    order: [],

    ajax: {
      url: "DataTransaksi/get_data_transaksi",
      type: "POST",
    },

    columnDefs: [
      {
        targets: [0],
        orderable: false,
      },
    ],
  });

  $("#show_data").on("click", ".receipt", function () {
    var seq = $(this).data("seq");
    $.ajax({
      type: "POST",
      url: "DataTransaksi/print_receipt",
      dataType: "JSON",
      data: { seq: seq },
      success: function (data) {},
    });
    return false;
  });

  // $("#show_data").on("click", ".pdf", function () {
  //   var seq = $(this).data("seq");
  //   $.ajax({
  //     type: "POST",
  //     url: "DataTransaksi/receipt_pdf",
  //     dataType: "JSON",
  //     data: { seq: seq },
  //     success: function (data) {},
  //   });
  //   return true;
  // });
});
