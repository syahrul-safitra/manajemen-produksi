@extends('Layouts.main')

@section('container')
    {{-- Container Fluid --}}
    <div class="mb-3">
        <h1 class="h3 mb-0 text-gray-800 mb-2">Pilih Produk</h1>
        <a href="{{ url('stok-produk/create') }}" class="btn btn-primary">Tambah</a>
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
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->nama_produk }}</td>
                                    <td>{{ $product->total }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ url('view-product/' . $product->nama_produk) }}"
                                                class="btn btn-sm btn-success" style="margin-right: 10px"> Pesan</a>
                                        </div>
                                    </td>
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

    <!-- Modal Logout -->
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
    </div>
@endsection
