 $(document).ready(function () {
        // Fungsi untuk memuat notifikasi saat halaman dimuat
        loadNotifications();

        function loadNotifications() {
            // Menggunakan Ajax untuk memuat jumlah pesanan yang telah selesai
            $.ajax({
                type: "GET",
                url: "get_notification_count.php",
                success: function (data) {
                    // Memperbarui jumlah notifikasi pada ikon lonceng
                    $("#notificationCount").text(data);

                    // Menyembunyikan badge jika jumlah notifikasi adalah 0
                    if (data == 0) {
                        $("#notificationCount").hide();
                    } else {
                        $("#notificationCount").show();
                    }

                    // Mengambil status notifikasi dari sessionStorage
                    var notificationStatus = sessionStorage.getItem("notificationStatus");

                    // Menyembunyikan badge jika status notifikasi adalah 'read'
                    if (notificationStatus === 'read') {
                        $("#notificationCount").show();
                    }
                }
            });
        }

        // Menampilkan popup notifikasi saat ikon lonceng diklik
        $("#notificationIcon").click(function () {
            // Menggunakan Ajax untuk mendapatkan daftar pesanan yang telah selesai
            $.ajax({
                type: "GET",
                url: "get_completed_orders.php",
                success: function (data) {
                    // Menampilkan popup notifikasi
                    $("#notificationPopupContent").html(data);
                    $("#notificationPopup").fadeIn();

                    // Menyembunyikan badge dan menyimpan status notifikasi ke sessionStorage
                    $("#notificationCount").hide();
                    sessionStorage.setItem("notificationStatus", "read");

                    // Memproses setiap tombol "Lihat Order" di dalam notifikasi
                    $(".btn-view-order").click(function () {
                        // Mengambil nilai Order Id
                        var orderId = $(this).data("order-id");

                        // Menyembunyikan notifikasi spesifik dengan Order Id yang sesuai
                        $(`#notificationItem${orderId}`).hide();

                        // Menyembunyikan popup notifikasi
                        $("#notificationPopup").fadeOut();
                    });
                }
            });
        });

        // Menutup popup notifikasi saat tombol ditutup
        $("#closeNotificationPopup").click(function () {
            $("#notificationPopup").fadeOut();
        });
    });