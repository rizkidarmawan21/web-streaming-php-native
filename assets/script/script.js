const ENDPOINT = "http://localhost/stream/";

$(document).ready(function () {
  // toggle navbar mobile
  $(".mobile-menu-button").each(function (_, navToggler) {
    var target = $(navToggler).data("target");
    $(navToggler).on("click", function () {
      $(target).animate({
        height: "toggle",
      });
    });
  });

  // user avatar dropdown
  var dd_btn = $(".dropdown-button");
  var dd_stream = $("#dropdown-stream");
  dd_btn.click(function () {
    dd_btn.each(function () {
      if (dd_stream.hasClass("hidden")) {
        dd_stream.removeClass("hidden").addClass("block");
      } else if (dd_stream.hasClass("block")) {
        dd_stream.removeClass("block").addClass("hidden");
      }
    });
  });
});

// kalau udah berlangganan panggil fungsi ini
function subcriptionTrue() {
  Swal.fire({
    // title: 'Are you sure?',
    text: "Anda telah memiliki paket yang sedang aktif",
    icon: "warning",
    // showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Ok",
  }).then((result) => {
    location.href = "dashboard.php";
  });
}


// kalau belum berlnagganan palinggul fungsi ini
function subcriptionCheckout(id, plan) {
  Swal.fire({
    title: "Anda Yakin ?",
    text: "Akan membeli paket langganan " + plan + " ?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Berlanganan Sekarang",
  }).then((result) => {
    if (result.isConfirmed) {
      let ajax = $.ajax({
        url: `${ENDPOINT}controllers/Subcription.php?action=checkout`,
        method: "POST",
        datatype: JSON,
        data: { idplan: id },
        async: true,
      });

      ajax.done((res) => {
        // console.log()
        const result = JSON.parse(res);
        SNAP(result.data.token);
      });

      ajax.fail((err) => {
        Swal.fire("Fail!", "Transaksi Gagal!", "error");
      });
    }
  });
}

// untuk menampilkan halaman pembayaran
let SNAP = (token) => {
  let status;
  let order_id;
  snap.pay(token, {
    onSuccess: (result) => {
      console.log(result);
      let ajaxStatus = $.ajax({
        url: `${ENDPOINT}controllers/Subcription.php?action=handling-status`,
        method: "POST",
        datatype: JSON,
        data: {
          status: 'paid',
          code_unique: result.order_id,
        },
      });
    
      ajaxStatus.done((res) => {
        // console.log()
        window.location.href = 'success_page.php'
      });
    
      ajaxStatus.fail((err) => {
        Swal.fire("Fail!", 'Update Status Pembayaran Gagal!', "error");
      });
    },
    onPending: (result) => {
      console.log(result);
      status = "pending";
      order_id = result.order_id;
    },

    onError: (result) => {
      console.log(result);
      status = "error";
      order_id = result.order_id;
    },
    onClose: () => {
      console.log(result);
      status = "pending";
      order_id = result.order_id;
    },
  });

 
};
