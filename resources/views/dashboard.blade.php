@extends('layouts.user_type.auth')


@section('content')
    @include('layouts.navbars.auth.navbar')





    <section class="py-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="product-grid row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 ">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <a href="itemList " style="text-decoration: none">
                                    <h5 class="card-title text-primary">Produk</h5>
                                    <div class="flex justify-between">

                                        <h6 class="card-subtitle mb-2 text-body-secondary">Jumlah Produk</h6>
                                        <h1 class="card-subtitle mb-2 text-body-secondary">{{ $data->count() }}</h1>
                                    </div>
                                </a>
                            </div>

                        </div>
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <a href="itemList " style="text-decoration: none">

                                    <h5 class="card-title text-primary">Kategori</h5>
                                    <div class="flex justify-between">
                                        <h6 class="card-subtitle mb-2 text-body-secondary">Jumlah kategori</h6>
                                        <h1 class="card-subtitle mb-2 text-body-secondary">{{ $kategori->count() }}
                                        </h1>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
