@extends('layouts.user_type.auth')

@section('content')
    @if (auth()->user()->level == 'admin')
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
    @endif
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <h3>History pembeli</h3>
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">no</th>
                        <th scope="col">Nama</th>
                        <th scope="col">total</th>
                        <th scope="col">quantity</th>
                        <th scope="col">tanggal</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($data as $row)
                        <tr>
                            <th scope="row">{{ $no++ }}</th>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->total_price }}</td>
                            <td>{{ $row->total_quantity }}</td>
                            <td>{{ $row->created_at }}</td>


                            <td>
                                <a href="/apus/{{ $row->id }}">
                                    <button type="button" class="btn btn-danger">hapus</button>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </main>
@endsection
