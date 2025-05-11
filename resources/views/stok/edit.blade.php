@extends('Layouts.main')

@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Unit Produk</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Unit Produk</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('unit-produk/' . $stok->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nama_produk">Nama Produk</label>
                                    <select class="form-control " name="nama_produk" id="nama_produk">
                                        <option value="">Pilih</option>
                                        @foreach ($products as $item)
                                            <option value="{{ $item->nama }}" @selected(@old('nama_produk', $stok->nama_produk) === $item->nama)>
                                                {{ $item->nama }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('nama_produk')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror "
                                        name="jumlah" id="jumlah" placeholder=""
                                        value="{{ @old('jumlah', $stok->jumlah) }}" min="1">

                                    @error('jumlah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                        </div>



                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection
