<nav class="main-menu d-flex navbar navbar-expand-lg">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
        aria-controls="offcanvasNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
                <li>
                    <a class="nav-link mx-1" href="dashboard">Dashboard</a>
                </li>
                <li>
                    <a class="nav-link mx-1" href="tables">Petugas</a>
                </li>
                <li>
                    <a class="nav-link mx-1" href="itemList">Daftar Produk</a>
                </li>
                <li>
                    <a class="nav-link mx-1" href="histori">Riwayat transaksi</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var currentLocation = window.location.href;

        var navLinks = document.querySelectorAll(".menu-list a");

        navLinks.forEach(function(link) {
            if (link.href === currentLocation) {
                link.classList.add("active");
                link.style.color = "#ffc43f";
            }
        });
    });
</script>
