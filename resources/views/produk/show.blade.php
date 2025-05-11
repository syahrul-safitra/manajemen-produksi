@extends('Layouts.main')

@section('container')
    <div class="mb-3">
        <h1 class="h3 mb-0 text-gray-800 mb-2">Detail Member</h1>
    </div>

    <div class="row">
        <div class="col-lg-10 mb-4">

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

                    <table class="table align-items-center table-striped">

                        <tbody>
                            <tr>
                                <th scope="row" style="width: 30%">Nama Lengkap</th>
                                <td style="width: 5%">:</td>
                                <td style="width: 65%">{{ $member->nama_lengkap }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 30%">NIK</th>
                                <td style="width: 5%">:</td>
                                <td style="width: 65%">{{ $member->nik }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 30%">Tempat Lahir</th>
                                <td style="width: 5%">:</td>
                                <td style="width: 65%">{{ $member->tempat_lahir }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 30%">Tanggal Lahir</th>
                                <td style="width: 5%">:</td>
                                <td style="width: 65%">{{ $member->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 30%">Jenis Kelamin</th>
                                <td style="width: 5%">:</td>
                                <td style="width: 65%">{{ $member->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 30%">Agama</th>
                                <td style="width: 5%">:</td>
                                <td style="width: 65%">{{ $member->agama }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 30%">Status Perkawinan</th>
                                <td style="width: 5%">:</td>
                                <td style="width: 65%">{{ $member->status_perkawinan }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 30%">Alamat</th>
                                <td style="width: 5%">:</td>
                                <td style="width: 65%">{{ $member->alamat }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 30%">RT</th>
                                <td style="width: 5%">:</td>
                                <td style="width: 65%">{{ $member->rt }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 30%">RW</th>
                                <td style="width: 5%">:</td>
                                <td style="width: 65%">{{ $member->rw }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 30%">Kelurahan/Desa</th>
                                <td style="width: 5%">:</td>
                                <td style="width: 65%">{{ $member->kelurahan_desa }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 30%">Kecamatan</th>
                                <td style="width: 5%">:</td>
                                <td style="width: 65%">{{ $member->kecamatan }}</td>
                            </tr>
                            <tr>
                                <th scope="row" style="width: 30%">Pekerjaan</th>
                                <td style="width: 5%">:</td>
                                <td style="width: 65%">{{ $member->pekerjaan }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>
    </div>
@endsection
