// Tambahkan fungsi untuk menampilkan/sembunyikan submenu
const toggleSubmenu = document.querySelectorAll('.toggle-submenu');

toggleSubmenu.forEach((menu) => {
    menu.addEventListener('click', function (e) {
        // Mencegah tindakan default dari tautan
        e.preventDefault();

        // Ambil semua submenu
        const submenus = document.querySelectorAll('.submenu');

        // Ambil ikon panah yang terletak di dalam menu
        const arrow = this.querySelector('.arrow');
        const submenu = this.nextElementSibling;

        // Tutup semua submenu terlebih dahulu, kecuali submenu yang sesuai dengan yang diklik
        submenus.forEach((sub) => {
            if (sub !== submenu) {
                sub.classList.remove('active');
            }
        });

        // Toggle status submenu yang diklik
        submenu.classList.toggle('active');

        // Putar ikon panah 90 derajat saat submenu ditampilkan
        if (submenu.classList.contains('active')) {
            arrow.style.transform = 'rotate(90deg)';
        } else {
            arrow.style.transform = 'rotate(0deg)';
        }
    });
});

// Tambahkan fungsi untuk menutup submenu dengan mengklik panah
const submenuArrow = document.querySelectorAll('.submenu .arrow');

submenuArrow.forEach((arrow) => {
    arrow.addEventListener('click', function (e) {
        // Mencegah tindakan default dari panah
        e.preventDefault();

        // Tutup submenu yang sesuai dengan panah yang diklik
        const submenu = this.parentElement;
        submenu.classList.remove('active');

        // Setel kembali panah ke posisi semula
        this.style.transform = 'rotate(0deg)';
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const currentLocation = location.href;
    const submenuLinks = document.querySelectorAll(".submenu a");

    submenuLinks.forEach((link) => {
        console.log(link)
        if (link.href === currentLocation) {
            link.classList.add("active");
            // You can also highlight the parent menu item if desired
            const parentMenu = link.closest(".submenu").previousElementSibling;
            if (parentMenu) {
                parentMenu.classList.add("active");
            }
            const arrowParentMenu = link.closest('.submenu');

            if (arrowParentMenu) {
                arrowParentMenu.classList.add('active');
            }

        }
    });
});

$(document).ready(function () {
    $('#example').DataTable({
        "scrollX": true,  // Aktifkan horizontal scrolling
        "scrollY": "350px"  // Aktifkan vertical scrolling dengan ketinggian 300px
    });
});
