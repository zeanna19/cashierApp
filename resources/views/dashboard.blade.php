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





    <section class="py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 ">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Produk</h5>
                                <div class="flex justify-between">

                                    <h6 class="card-subtitle mb-2 text-body-secondary">Jumlah Produk</h6>
                                    <h1 class="card-subtitle mb-2 text-body-secondary">{{ $data->count() }}</h1>
                                </div>
                            </div>

                        </div>
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Kategori</h5>
                                <div class="flex justify-between">
                                    <h6 class="card-subtitle mb-2 text-body-secondary">Jumlah kategori</h6>
                                    <h1 class="card-subtitle mb-2 text-body-secondary">{{ $kategori->count() }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
