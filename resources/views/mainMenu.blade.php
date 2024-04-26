@extends('layouts.user_type.auth')


@section('content')
    @if (auth()->user()->level == 'admin')
        @include('layouts.navbars.auth.navbar')
    @endif

    @if (auth()->user()->level == 'petugas')
        <section class="py-5 overflow-hidden">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">

                        <div class="section-header d-flex flex-wrap justify-content-between mb-5">
                            <h2 class="section-title">Category</h2>
                            @if (auth()->user()->level == 'admin')
                                <a href="AddKategori">
                                    <button type="button" class="btn btn-success">Tambah kategori</button>
                                </a>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="category-carousel swiper">
                            <div class="swiper-wrapper">
                                <a href="#" class="nav-link category-item swiper-slide" data-kategori-id="semua">
                                    <h3 class="category-title">Semua</h3>
                                </a>
                                @foreach ($kategori as $Kategori)
                                    <a href="#" class="nav-link category-item swiper-slide"
                                        data-kategori-id="{{ $Kategori->id }}">
                                        <h3 class="category-title">{{ $Kategori->jenis }}</h3>
                                    </a>
                                @endforeach


                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (auth()->user()->level == 'petugas')
        <section class="py-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="bootstrap-tabs product-tabs">
                            <div class="tabs-header d-flex justify-content-between border-bottom my-5">
                                <h3>select product</h3>

                            </div>
                            <div id="search-results"></div>

                            <div class=" row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 ">
                                @foreach ($data as $product)
                                    <div class="col product-item" data-kategori-id="{{ $product->kategori_id }}">

                                        <figure>
                                            <img src="{{ asset('storage/image/' . $product->foto) }}"
                                                alt="{{ $product->nama }}">

                                        </figure>
                                        <h3 class="product-title">{{ $product->nama }}</h3>
                                        <span class="price text-primary">Rp.{{ $product->harga }}</span>
                                        <span class="qty">{{ $product->kategori->jenis }}</span>




                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="input-group product-qty">
                                                <div class="input-group-prepend">
                                                    <button type="button"
                                                        class="quantity-left-minus btn btn-danger btn-number"
                                                        data-type="minus" data-target="quantity{{ $loop->iteration }}"
                                                        onclick="updateQuantity('minus', 'quantity{{ $loop->iteration }}')">
                                                        <svg width="16" height="16">
                                                            <use xlink:href="#minus"></use>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <input type="text" id="quantity{{ $loop->iteration }}"
                                                    name="quantity{{ $loop->iteration }}" class="form-control input-number"
                                                    value="0" data-product-price="{{ $product->harga }}">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-success btn-number"
                                                        data-type="plus" data-target="quantity{{ $loop->iteration }}"
                                                        onclick="updateQuantity('plus', 'quantity{{ $loop->iteration }}')">+</button>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-cart p-3"
                                                onclick="addToCart('quantity{{ $loop->iteration }}')">Tambah
                                                <i class="fas fa-shopping-cart"></i>
                                            </button>
                                        </div>

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
    @endif

    <script>
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

        function checkQuantity(target) {
            var quantity = parseInt(document.getElementById(target).value);
            var addToCartBtn = document.querySelector(`button[data-target="${target}"]`);
            if (quantity > 0) {
                addToCartBtn.disabled = false;
            } else {
                addToCartBtn.disabled = true;
            }
        }

        function updateTotalPrice(target, quantity, price) {
            var totalPriceSpan = document.querySelector(`#totalPrice_${target}`);
            if (totalPriceSpan) {
                totalPriceSpan.innerText = (parseFloat(quantity) * price).toFixed(2);
            }
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
                var cartPopup = document.getElementById('cartPopup');
                cartPopup.innerHTML = 'Berhasil memasukkan barang ke keranjang';
                cartPopup.classList.add('show');
                setTimeout(function() {
                    cartPopup.classList.remove('show');
                }, 2000);
                cartItems.push(item);
                updateCartUI();
                saveCartToStorage();

                quantityInput.value = 0;
                checkQuantity(target);
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


        function closeCartPopup() {
            var cartPopup = document.getElementById('cartPopup');
            cartPopup.classList.remove('show');
        }

        var productItems = document.querySelectorAll('.product-item');
        productItems.forEach(function(item, index) {
            var itemNumber = index + 1;
            item.dataset.itemNumber = itemNumber;
        });
        document.addEventListener("DOMContentLoaded", function() {
            function showProductsByCategory(category) {
                var productItems = document.querySelectorAll('.product-item');
                productItems.forEach(function(item) {
                    var itemCategory = item.dataset.category;
                    if (itemCategory === category || category === 'All') {
                        item.style.display = 'block';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            var categoryLinks = document.querySelectorAll('.category-item');
            categoryLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    var category = link.dataset.category;
                    showProductsByCategory(category);
                });
            });

            showProductsByCategory('All');
        });



        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.category-item').forEach(item => {
                item.addEventListener('click', event => {
                    event.preventDefault();
                    const kategoriId = item.dataset.kategoriId;
                    filterBarangByKategori(kategoriId);
                });
            });
        });


        function filterBarangByKategori(kategoriId) {
            const semuaBarang = document.querySelectorAll('.product-item');
            semuaBarang.forEach(barang => {
                const kategoriProduk = barang.dataset.kategoriId;
                if (kategoriId === 'semua' || kategoriProduk === kategoriId) {
                    barang.style.display = 'block';
                } else {
                    barang.style.display = 'none';
                }
            });
        }
    </script>
@endsection
