@extends('Layouts.main')

@section('container')
    {{-- Container Fluid --}}
    <div class="mb-3">
        <h1 class="h3 mb-0 text-gray-800 mb-2">Produk</h1>
        @can('admin')
            <a href="{{ url('produk/create') }}" class="btn btn-primary">Tambah</a>
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
                                <th>Harga</th>
                                @can('admin')
                                    <th style="text-align: center">Action</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->nama }}</td>
                                    <td>{{ $product->harga }}</td>
                                    @can('admin')
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ url('produk/' . $product->id . '/edit') }}"
                                                    class="btn btn-sm btn-warning" style="margin-right: 10px"> Edit</a>

                                                <form action="{{ url('produk/' . $product->id) }}" method="POST"
                                                    onclick="return confirm('Data produk akan dihapus.')">
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
