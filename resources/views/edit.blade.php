@extends('layouts.user_type.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <form action="/updatedata/{{ $data->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="jumlahBayar" class="form-label">Jumlah Bayar</label>
                                <input type="text" name="jumlahBayar" class="form-control"
                                    value="{{ $data->jumlahBayar }}">
                            </div>
                            <table class="table mt-5">
                                <thead>
                                    <tr>
                                        <th scope="col">no</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">total</th>
                                        <th scope="col">quantity</th>
                                        <th scope="col">tanggal</th>
                                        <th scope="col">jumlah bayar</th>
                                        <th scope="col">status</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $row)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->total_price }}</td>
                                            <td>{{ $row->total_quantity }}</td>
                                            <td>{{ $row->created_at->format('d M Y') }}</td>
                                            <td>{{ $row->jumlahBayar }}</td>
                                            <td>
                                                @php
                                                    $buttonClass = $row->status === 'lunas' ? 'success' : 'danger';
                                                @endphp
                                                <button type="button"
                                                    class="btn btn-{{ $buttonClass }}">{{ $row->status }}</button>
                                            </td>

                                            <td>
                                                <a href="/apus/{{ $row->id }}">

                                                    <img src="assets/images/del_alt.png" alt="">
                                                </a>
                                                <button type="button" class="btn">
                                                    <img src="assets/images/Desk.png" alt=""
                                                        onclick="showStrukModal({{ json_encode($row) }})">
                                                </button>
                                                <a href="/edit/{{ $row->id }}">
                                                    <button type="button" class="btn btn-danger">edit</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
