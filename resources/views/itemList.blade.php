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
                    <ul class="navbar-nav justify-content-end menu-list list-unstyled d-flex gap-md-3 mb-0">
                        <li>
                            <a class="nav-link mx-1" href="dashboard">Dashboard</a>
                        </li>
                        <li>
                            <a class="nav-link mx-1" href="tables">Petugas</a>
                        </li>
                        <li>
                            <a class="nav-link mx-1" href="itemList">Item List</a>
                        </li>
                        <li>
                            <a class="nav-link mx-1" href="histori">history transaksi</a>
                        </li>
                    </ul>
                </ul>
            </div>
        </div>
    </nav>



    <section class="py-5 overflow-hidden">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="section-header d-flex flex-wrap justify-content-between mb-5">
                        <h2 class="section-title">Category</h2>
                        <a href="AddKategori">
                            <button type="button" class="btn btn-success">Tambah kategori</button>
                        </a>
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
                                <div class="col product-item" data-kategori-id="{{ $product->kategori_id }}">
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
                                    <span class="qty">{{ $product->kategori->jenis }}</span>

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


        // mengatur sesuai kategori
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
