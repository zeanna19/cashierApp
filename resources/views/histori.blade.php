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
                                <a href="/apus/{{ $row->id }}">
                                    <button type="button" class="btn btn-danger">hapus</button>
                                </a>
                                <button type="button" class="btn btn-primary"
                                    onclick="showDetailModal({{ json_encode($row) }})">Detail</button>
                            </td>
                        </tr>
                    @endforeach


                    <!-- Modal -->
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
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" onclick="exportBill()">Export
                                        Bill</button>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>

        </tbody>
        </table>

        </div>
        <script>
            function showDetailModal(data) {
                var detailContent = document.getElementById('detailContent');
                var kembalianHTML = '';

                if (data.jumlahBayar >= data.total_price) {
                    var kembalian = data.jumlahBayar - data.total_price;
                    kembalianHTML = ` 
                        <p> ${kembalian}</p>
                        `;
                }

                var tanggal = new Date(data.created_at);
                var formattedDate = tanggal.getDate() + ' ' + getMonthName(tanggal.getMonth()) + ' ' + tanggal.getFullYear();

                detailContent.innerHTML = `
                
<div class="detail-item">
    <div class="flex justify-between">
    <h5>Detail Transaksi</h5>
    <p> ${formattedDate}</p>
</div>

    <h3> ${data.name}</h3>

    <div class="flex justify-between">
        <p>Total Harga:</p>
        <h3 class="text-primary">${data.total_price}</h3>
    </div>
    <hr>
    <p><strong>membeli</strong> ${data.total_quantity}  product</p>
    <p><strong>membeli</strong> ${data.nama}  product</p>
    <hr>
      <div class="flex justify-between">
        <h5>Total membayar</h5>
        <h5 class="text-primary">${data.jumlahBayar}</h5>
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
                    detailContent.innerHTML += `<p class="text-danger">Transaksi harus lunas sebelum mencetak struk.</p>`;
                }
                detailContent.dataset.status = data.status;
                var detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
                detailModal.show();
            }

            function getMonthName(monthIndex) {
                var months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                return months[monthIndex];
            }

            function exportBill() {
                var statusElement = document.getElementById('detailContent');
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
        </script>




    </main>
@endsection
