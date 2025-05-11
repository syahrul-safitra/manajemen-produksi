@extends('Layouts.main')

@section('container')
    {{-- Container Fluid --}}
    <div class="mb-3">
        <h1 class="h3 mb-0 text-gray-800 mb-2">Unit Produk</h1>
        @can('admin')
            <a href="{{ url('unit-produk/create') }}" class="btn btn-primary">Tambah</a>
        @endcan
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
                                <th>Tanggal</th>
                                @can('admin')
                                    <th style="text-align: center">Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stokProducts as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->nama_produk }}</td>
                                    <td>{{ $product->jumlah }}</td>
                                    <td>{{ date('d-m-Y', strtotime($product->created_at)) }}</td>
                                    @can('admin')
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ url('unit-produk/' . $product->id . '/edit') }}"
                                                    class="btn btn-sm btn-warning" style="margin-right: 10px"> Edit</a>
                                                <form action="{{ url('unit-produk/' . $product->id) }}" method="POST"
                                                    onclick="return confirm('Data stok produk akan dihapus.')">
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
@endsection
