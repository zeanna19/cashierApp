@extends('layouts.user_type.auth')

@section('content')
    @include('layouts.navbars.auth.navbar')

    <div class="container">
        <div class="row justify-content-end">
            <div class="col">
                <div class="card mt-4">
                    <div class="card-body">
                        <form action="/insertKategori" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis barang</label>
                                <div class="mb-3">
                                    <input type="text" name="jenis" class="form-control" id="jenis" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
