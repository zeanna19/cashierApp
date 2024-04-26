@extends('layouts.user_type.auth')

@section('content')
    @include('layouts.navbars.auth.navbar')

    <div class="container">
        <div class="row justify-content-end">
            <div class="col">
                <div class="card mt-4">
                    <div class="card-body">
                        <form action="/insertdata" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis barang</label>
                                <select class="form-select" name="jenis" id="jenis"
                                    aria-label="Default select example" required>
                                    <option selected disabled>Pilih kategori</option>
                                    @foreach ($kategori as $Kategori)
                                        <option value="{{ $Kategori->id }}">{{ $Kategori->jenis }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga barang</label>
                                <input type="number" name="harga" class="form-control" id="harga" required>
                            </div>
                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" name="foto" class="form-control" id="foto" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
