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
                </div>
            </div>
        </nav>
    @endif
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <h3>History pembeli</h3>
            @if ($data->isEmpty())
                <p>Tidak ada produk yang tersedia dalam histori.</p>
            @else
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
                                    <button type="button" class="btn btn-{{ $buttonClass }}">{{ $row->status }}</button>
                                </td>

                                <td>
                                    <button class="btn">
                                        <a href="/apus/{{ $row->id }}">
                                            <img src="assets/images/del_alt.png" alt="">
                                        </a>
                                    </button>
                                    <button type="button" class="btn">
                                        <img src="assets/images/Desk.png" alt=""
                                            onclick="showStrukModal({{ json_encode($row) }})">
                                    </button>
                                    <button type="button" class="btn">
                                        <img src="assets/images/Paper.png" alt=""
                                            onclick="showDetailModal({{ json_encode($row) }})">
                                    </button>
                                </td>
                            </tr>
                        @endforeach


                        <!-- Modal struk-->
                        <div class="modal fade" id="strukModal" tabindex="-1" aria-labelledby="detailModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div id="strukContent"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" onclick="exportBill()">Export
                                            Bill</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        {{-- modal detail --}}
                        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div id="detailContent"></div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </tbody>
                </table>
            @endif
        </div>
        </div>
        <script>
            function showStrukModal(data) {
                var detailContent = document.getElementById('strukContent');
                var kembalianHTML = '';

                if (data.jumlahBayar >= data.total_price) {
                    var kembalian = data.jumlahBayar - data.total_price;
                    kembalianHTML = ` 
                        <p> ${kembalian}</p>
                        `;
                }

                var tanggal = new Date(data.created_at);
                var formattedDate = tanggal.getDate() + ' ' + getMonthName(tanggal.getMonth()) + ' ' + tanggal.getFullYear();

                strukContent.innerHTML = `
                
<div class="detail-item">
    <div class="flex justify-between">
    <h5>Detail Transaksi</h5>
    <p> ${formattedDate}</p>
</div>

    <h3> ${data.name}</h3>
    <p><strong>membeli</strong> ${data.total_quantity}  product</p>

    <div class="flex justify-between">
        <p>Total Harga:</p>
        <h3 class="text-primary">Rp.${data.total_price}</h3>

    </div>

    <hr>
      <div class="flex justify-between">
        <h5>Total membayar</h5>
        <h5 class="text-primary">Rp.${data.jumlahBayar}</h5>
    </div>
    <div class="flex justify-between"> 
        <h6>Kembalian</h6>
        <h6 class="text-primary">${kembalianHTML}</h6>
    </div>
    <div class="flex justify-between"> 

        <p><strong>status</strong></p>

        <p><strong>${data.status}</strong></p>
        </div>
        
</div>

    `;
                if (data.status !== 'lunas') {
                    strukContent.innerHTML += `<p class="text-danger">Transaksi harus lunas sebelum mencetak struk.</p>`;
                }
                strukContent.dataset.status = data.status;
                var strukModal = new bootstrap.Modal(document.getElementById('strukModal'));
                strukModal.show();
            }

            function getMonthName(monthIndex) {
                var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                return months[monthIndex];
            }

            function exportBill() {
                var statusElement = document.getElementById('strukContent');
                if (!statusElement) {
                    console.error('Element with ID "detailContent" not found.');
                    return;
                }
                var status = statusElement.dataset.status;

                console.log('Status:', status);

                if (status === 'lunas') {
                    window.print();
                } else {
                    var exportButton = document.getElementById('exportButton');
                    if (exportButton) {
                        exportButton.disabled = true;
                    }
                }
            }



            // model detail
            function showDetailModal(data) {
                var detailContent = document.getElementById('detailContent');
                var kembalianHTML = '';

                if (data.jumlahBayar >= data.total_price) {
                    var kembalian = data.jumlahBayar - data.total_price;
                    kembalianHTML = ` 
                        <p>Rp. ${kembalian}</p>
                        `;
                }

                var tanggal = new Date(data.created_at);
                var formattedDate = tanggal.getDate() + ' ' + getMonthName(tanggal.getMonth()) + ' ' + tanggal.getFullYear();

                detailContent.innerHTML = `
                
<div class="detail-item">
    <div class="flex justify-between">
    <h5>Detail Transaksi</h5>
</div>

    <h3> ${data.name}</h3>

    <div class="flex justify-between">
        <p>Total Harga: ${data.total_quantity}  produk</p>
        <h3 class="text-primary">Rp.${data.total_price}</h3>
    </div>
    <hr>
      <div class="flex justify-between">
        <h5>Total membayar</h5>
        
        <h5 class="text-primary">Rp.${data.jumlahBayar}</h5>
    </div>
    <div class="flex justify-between"> 
        <h6>Kembalian</h6>
        <h6 class="text-primary">${kembalianHTML}</h6>
    </div>
    <div class="flex justify-between"> 
        <p><strong>status</strong></p>
        <p><strong>${data.status}</strong></p>
        </div>
     

@if ($data->isNotEmpty() && $data->first()->status !== 'lunas')
   <hr>
    <form id="jumlahBayarForm" action="/update/{{ $data->first()->id }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="bayarBaru" class="form-label">Jumlah Bayar</label>
            <input type="number" class="form-control" id="bayarBaru" name="bayarBaru" placeholder="jumlah bayar">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
@endif


</div>

    `;



                detailContent.dataset.status = data.status;
                var detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
                detailModal.show();
            }

            function getMonthName(monthIndex) {
                var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                return months[monthIndex];
            }
        </script>




    </main>
@endsection
