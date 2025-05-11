@extends('Layouts.main')

@section('container')
    {{-- Container Fluid --}}
    <div class="mb-3">
        <h1 class="h3 mb-0 text-gray-800 mb-2">Riwayat Pesanan</h1>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Cetak Laporan
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cetak Laporan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ url('cetak-order') }}" method="POST">
                        <div class="modal-body">
                            <div class="modal-body">
                                <p>Masukan tanggal awal dan akhir</p>
                            </div>
                            <div class="modal-footer">
                                @csrf
                                <input type="date" class="form-control" name="tanggal_awal">
                                <input type="date" class="form-control" name="tanggal_akhir">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Cetak</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>

    <div class="row">
        <div class="col-lg-12 mb-4">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible mb-3" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Simple Tables -->
            <div class="card">
                <div class="table-responsive table-hover">

                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Costumer</th>
                                <th>No Hp</th>
                                <th>Nama Barang</th>
                                <th>Jenis Pesanan</th>
                                <th>Tanggal</th>
                                <th>Harga (satuan)</th>
                                <th>Jumlah</th>
                                <th>Total</th>
                                <th>Status</th>
                                @can('admin')
                                    <th style="text-align: center">Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->nama_costumer }}</td>
                                    <td>{{ $order->no_hp }}</td>
                                    <td>{{ $order->nama_produk }}</td>
                                    <td>{{ $order->jenis_pesanan }}</td>
                                    <td>{{ date('d-m-Y', strtotime($order->tanggal_pesanan)) }}</td>
                                    <td>{{ 'Rp ' . number_format($order->produk->harga, 0, ',', '.') }}</td>
                                    <td>{{ $order->jumlah }}</td>
                                    <td>{{ 'Rp ' . number_format($order->total, 0, ',', '.') }}</td>
                                    <td>
                                        <span
                                            class="badge {{ $order->status === 'blm_lunas' ? 'badge-danger' : 'badge-success' }}">{{ $order->status === 'blm_lunas' ? 'Belum Lunas' : 'Lunas' }}</span>
                                    </td>

                                    @can('admin')
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ url('order/' . $order->id . '/edit') }}"
                                                    class="btn btn-sm btn-warning" style="margin-right: 10px"> Edit</a>

                                                <form action="{{ url('order/' . $order->id) }}" method="POST"
                                                    onclick="return confirm('Data order akan dihapus.')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
    <!--Row-->

    {{-- <!-- Modal Logout -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                    <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
