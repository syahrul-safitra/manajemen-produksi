@extends('Layouts.main')

@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Pesanan</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Produk</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('order') }}" method="POST">
                        @csrf

                        <input type="hidden" id="harga" value="{{ $product->harga }}">
                        <input type="hidden" name="nama_produk" value="{{ $product->nama }}">


                        <div class="row">
                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label for="nama_costumer">Nama Costumer</label>
                                    <input type="text" class="form-control @error('nama_costumer') is-invalid @enderror "
                                        id="nama" name="nama_costumer" placeholder=""
                                        value="{{ @old('nama_costumer') }}">

                                    @error('nama_costumer')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="no_hp">No HP</label>
                                    <input type="text" class="form-control @error('no_hp') is-invalid @enderror "
                                        id="no_hp" name="no_hp" placeholder="" value="{{ @old('no_hp') }}">

                                    @error('no_hp')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="tanggal_pesanan">Tanggal Pesanan</label>
                                    <input type="date"
                                        class="form-control @error('tanggal_pesanan') is-invalid @enderror "
                                        id="tanggal_pesanan" name="tanggal_pesanan" placeholder=""
                                        value="{{ @old('tanggal_pesanan') }}">

                                    @error('tanggal_pesanan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jenis_pesanan">Jenis Pesanan</label>
                                    <input type="text" class="form-control @error('jenis_pesanan') is-invalid @enderror "
                                        id="jenis_pesanan" name="jenis_pesanan" placeholder=""
                                        value="{{ @old('jenis_pesanan') }}">

                                    @error('jenis_pesanan')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                            </div>

                            <div class="col-lg-6">

                                <div class="form-group">
                                    <label for="nama_produk">Nama Produk</label>
                                    <input type="text" class="form-control @error('nama_produk') is-invalid @enderror "
                                        id="nama_produk" placeholder=""
                                        value="{{ $product->nama . ' (stok : ' . $stokProduct . ')' }}" readonly>
                                    @error('nama_produk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="harga_produk">Harga</label>
                                    <input type="text" class="form-control @error('harga_produk') is-invalid @enderror "
                                        id="harga_produk" placeholder=""
                                        value="{{ 'Rp ' . number_format($product->harga, 0, ',', '.') }}" readonly>
                                    @error('harga_produk')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jumlah">Jumlah</label>
                                    <input type="number" class="form-control @error('jumlah') is-invalid @enderror "
                                        name="jumlah" id="jumlah" placeholder="" value="{{ @old('jumlah') }}"
                                        min="1" max="{{ $stokProduct }}">

                                    @error('jumlah')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="total">Total Harga</label>
                                    <input type="text" class="form-control @error('total') is-invalid @enderror "
                                        name="total" id="total" placeholder="" value="{{ @old('total') }}"
                                        min="1" readonly>

                                    @error('total')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Status Pembayaran</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="status" value="blm_lunas" name="status"
                                            class="custom-control-input" @checked(@old('status') === 'blm_lunas')>
                                        <label class="custom-control-label" for="status">Belum Lunas</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" id="perempuan" name="status" value="lunas"
                                            class="custom-control-input" @checked(@old('status') === 'lunas')>
                                        <label class="custom-control-label" for="perempuan">Lunas</label>
                                    </div>

                                    @error('status')
                                        <p class="text-danger">
                                            {{ $message }}
                                        </p>
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
