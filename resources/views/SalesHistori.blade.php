@extends('layouts.user_type.auth')


@section('content')
    <section class="py-5">
        <div class="container-fluid">
            <h3 class="text-center mb-5 mt-5">Table Absensi Siswa</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Total Payment</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($salesHistory as $sales)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sales->total_payment }}</td>
                            <td>{{ $sales->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </section>
@endsection
