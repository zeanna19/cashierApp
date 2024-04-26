@extends('layouts.user_type.auth')

@section('content')
    @include('layouts.navbars.auth.navbar')

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

                            <td>
                                <a href="/hapus/{{ $row->id }}" class="delete-link" data-id="{{ $row->id }}">
                                    <button type="button" class="btn btn-danger">Hapus</button>
                                </a>
                            </td>

                            <div class="confirmation-background" id="confirmationBackground">
                                <div class="confirmation-popup" id="confirmationPopup">
                                    <div class="confirmation-content">
                                        <p>Apakah Anda yakin ingin menghapus item ini?</p>
                                        <button class="btn btn-blue" id="confirmDelete">Hapus</button>
                                        <button class="btn btn-red" id="cancelDelete">Batal</button>
                                    </div>
                                </div>
                            </div>


                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </main>
    <script>
        const deleteLinks = document.querySelectorAll('.delete-link');
        const confirmationBackground = document.getElementById('confirmationBackground');
        const confirmationPopup = document.getElementById('confirmationPopup');
        const confirmDeleteButton = document.getElementById('confirmDelete');
        const cancelDeleteButton = document.getElementById('cancelDelete');

        deleteLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();
                confirmationBackground.style.display = 'block';
                confirmationPopup.style.display = 'block';
                const deleteUrl = link.getAttribute('href');
                confirmDeleteButton.onclick = function() {
                    window.location.href = deleteUrl;
                }
            });
        });

        cancelDeleteButton.onclick = function() {
            confirmationBackground.style.display = 'none';
            confirmationPopup.style.display = 'none';
        };
    </script>
@endsection
