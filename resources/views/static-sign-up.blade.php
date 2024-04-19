@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
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
    </div>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <h3 class="mb-5">Register Petugas</h3>
            <div class="col-md-12 col-lg-10">
                <div class="wrap d-md-flex">
                    <div class="img" style="background-image: url(assets/images/bgdoodle.jpeg);">
                    </div>
                    <div class="login-wrap p-4 p-md-5">
                        <div class="d-flex">
                            <div class="w-100">
                                <h3 class="mb-4">Sign up</h3>
                            </div>
                        </div>
                        <form role="form text-left" method="POST" action="/inputdata">
                            @csrf
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Name" name="name" id="name"
                                    aria-label="Name" aria-describedby="name" value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Email" name="email" id="email"
                                    aria-label="Email" aria-describedby="email-addon" value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="password" class="form-control" placeholder="Password" name="password"
                                    id="password" aria-label="Password" aria-describedby="password-addon">
                                @error('password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="level" class="form-control" placeholder="level" name="level" id="level"
                                    aria-label="level" value="{{ old('level') }}">
                                @error('level')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100 my-4 mb-2">Sign up</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
