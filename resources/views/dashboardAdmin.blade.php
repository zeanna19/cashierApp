@extends('layouts.user_type.auth')


@section('content')
    <nav class="main-menu d-flex navbar navbar-expand-lg">

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar"
            aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
                    <li>
                        <a class="nav-link mx-1" href="tables">Petugas</a>
                    </li>
                    <li>
                        <a class="nav-link mx-1" href="dashboardAdmin">Item List</a>
                    </li>
                    <li>
                        <a class="nav-link mx-1" href="histori">history transaksi</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>





    <section class="py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="bootstrap-tabs product-tabs">
                        <div class="tabs-header d-flex justify-content-between border-bottom my-5">
                            <h3>List Product</h3>
                            <a href="AddProduct">
                                <button type="button" class="btn btn-success">Tambah product</button>
                            </a>
                        </div>
                        <div id="search-results"></div>

                        <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 ">
                            @foreach ($data as $product)
                                <div class="col product-item" data-category="{{ $product->category }}">
                                    <form action="{{ route('deleteproduct', ['id' => $product->id]) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn remove-product"><i
                                                class="fas fa-trash-alt"></i></button>
                                    </form>
                                    <figure>
                                        <img src="{{ asset('storage/image/' . $product->foto) }}"
                                            alt="{{ $product->nama }}">
                                    </figure>
                                    <h3 class="product-title">{{ $product->nama }}</h3>
                                    <span class="price text-primary">Rp.{{ $product->harga }}</span>
                                    <span class="qty">{{ $product->stok }} Unit</span>

                                </div>
                            @endforeach





                            <div id="cartPopup" class="cart-popup ">
                                <span class="close-popup" onclick="closeCartPopup()">&times;</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function deleteProduct(productId) {
            if (confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
                fetch(`/products/${productId}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Gagal menghapus produk');
                        }
                        const productElement = document.querySelector(`.product-item[data-id="${productId}"]`);
                        if (productElement) {
                            productElement.remove();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus produk');
                    });
            }
        }



        var cartItems = [];

        function updateQuantity(action, target) {
            var quantityInput = document.querySelector(`#${target}`);
            var quantity = parseInt(quantityInput.value);
            var productPrice = parseFloat(quantityInput.getAttribute('data-product-price'));

            if (action === 'plus') {
                quantityInput.value = quantity + 1;
            } else if (action === 'minus' && quantity > 0) {
                quantityInput.value = quantity - 1;
            }

            updateTotalPrice(target, quantityInput.value, productPrice);
            checkQuantity(target);


        }

        function checkQuantity() {
            var quantity = parseInt(document.getElementById('quantity1').value);
            var addToCartBtn = document.getElementById('addToCartBtn');
            if (quantity > 0) {
                addToCartBtn.disabled = false;

            } else {
                addToCartBtn.disabled = true;
            }
        }

        function updateTotalPrice(target, quantity, price) {
            var totalPriceSpan = document.querySelector(`#totalPrice_${target}`);
            totalPriceSpan.innerText = (parseFloat(quantity) * price).toFixed(2);
        }

        function addToCart(target) {
            var quantityInput = document.getElementById(target);
            var quantity = parseInt(quantityInput.value);
            if (quantity === 0) return;

            var productName = quantityInput.closest('.product-item').querySelector('h3').innerText;

            var productPrice = parseFloat(quantityInput.getAttribute('data-product-price'));
            var totalPrice = productPrice * quantity;

            quantityInput.setAttribute('data-product-name', productName);

            var item = {
                name: productName,
                price: productPrice,
                quantity: quantity,
                total: totalPrice,
                target: target
            };


            var found = false;
            for (var i = 0; i < cartItems.length; i++) {
                if (cartItems[i].name === productName) {
                    found = true;
                    break;
                }
            }
            if (found) {
                var cartPopup = document.getElementById('cartPopup');
                cartPopup.innerHTML = 'Produk sudah ada di keranjang.';
                cartPopup.classList.add('show');
                setTimeout(function() {
                    cartPopup.classList.remove('show');
                }, 2000);
            } else {
                var
                    cartPopup = document.getElementById('cartPopup');
                cartPopup.innerHTML = 'berhasil memasukkan barang ke keranjang'
                cartPopup.classList.add('show');
                setTimeout(function() {
                    cartPopup.classList.remove('show');
                }, 2000);
                cartItems.push(item);
                updateCartUI();
                saveCartToStorage();
                quantityInput.value = 0;
            }
        }

        function loadCartFromStorage() {
            var storedCartItems = localStorage.getItem('cartItems');
            if (storedCartItems) {
                cartItems = JSON.parse(storedCartItems);
                updateCartUI();
            }
        }

        function saveCartToStorage() {
            localStorage.setItem('cartItems', JSON.stringify(cartItems));
        }
        window.onload = loadCartFromStorage;

        function
        closeCartPopup() {
            var cartPopup = document.getElementById('cartPopup');
            cartPopup.classList.remove('show');
        }
        var
            productItems = document.querySelectorAll('.product-item');
        productItems.forEach(function(item, index) {
            var
                itemNumber = index + 1;
            item.dataset.itemNumber = itemNumber;
        });
        document.addEventListener("DOMContentLoaded",
            function() {
                function showProductsByCategory(category) {
                    var
                        productItems = document.querySelectorAll('.product-item');
                    productItems.forEach(function(item) {
                        var
                            itemCategory = item.dataset.category;
                        if (itemCategory === category || category === 'All') {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                }
                var
                    categoryLinks = document.querySelectorAll('.category-item');
                categoryLinks.forEach(function(link) {
                    link.addEventListener('click', function(event) {
                        event.preventDefault();
                        var category = link.dataset.category;
                        showProductsByCategory(category);
                    });
                });
                showProductsByCategory('All');
            });
    </script>
@endsection
