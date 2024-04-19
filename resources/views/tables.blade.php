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
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">

        <div class="container-fluid py-4">
            <h3 class="mb-3">List Petugas</h3>
            <table class="table mt-5">
                <thead>
                    <a href="static-sign-up">
                        <button type="button" class="btn btn-success">Tambah petugas</button>
                    </a>
                    <tr>
                        <th scope="col">no</th>
                        <th scope="col">Nama</th>
                        <th scope="col">email</th>
                        <th scope="col">level</th>
                        <th scope="col">password</th>
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
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->level }}</td>
                            <td>{{ $row->password }}</td>

                            <td>
                                <a href="/hapus/{{ $row->id }}">
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
