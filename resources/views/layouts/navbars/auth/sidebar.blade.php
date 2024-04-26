{{-- <script>
    window.addEventListener('message', function(event) {
        const orderList = document.getElementById('orderList');

        if (event.data.remove) {
            // Hapus semua item dari daftar pesanan
            orderList.innerHTML = '';
        } else {
            // Tambahkan item ke daftar pesanan
            const item = document.createElement('li');
            item.textContent = `${event.data.name} - ${event.data.price} x ${event.data.quantity}`;
            orderList.appendChild(item);
        }
    });
</script>

<nav class="col-md-3 col-lg-2 d-md-block sidebar fixed-right" style="background-color: white">
    <div class="sidebar-sticky">
        <h5 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            Order detail
        </h5>
        <ul class="nav flex-column" id="orderList">
             Daftar pesanan akan ditambahkan di sini
</ul>
</div>
</nav> --}}
