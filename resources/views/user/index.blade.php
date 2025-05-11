@extends('Layouts.main')

@section('container')
    {{-- Container Fluid --}}
    <div class="mb-3">
        <h1 class="h3 mb-0 text-gray-800 mb-2">User (Owner)</h1>
        <a href="{{ url('user/create') }}" class="btn btn-primary">Tambah</a>
        <a href="{{ url('user/' . 1 . '/edit') }}" class="btn btn-info">Edit Admin</a>
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
                                <th>Email</th>
                                <th style="text-align: center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ url('user/' . $user->id . '/edit') }}"
                                                class="btn btn-sm btn-warning" style="margin-right: 10px"> Edit</a>

                                            <form action="{{ url('user/' . $user->id) }}" method="POST"
                                                onclick="return confirm('Data user akan dihapus.')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
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
@endsection
