<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk</title>
</head>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: 0;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        background-color: #fff;
        height: 100vh;
    }

    img {
        width: 80px;
    }

    .kop {
        width: 750px;
        margin: 0 auto;
        padding: 20px;
    }

    .tengah {
        text-align: center;
    }

    .table-1 {
        margin: 0 auto;
    }

    .container {
        width: fit-content;
        margin: 0 auto;
    }

    .isi {
        width: 750px;
        margin: 0 auto;
        border: 1px solid black;
    }

    .table-2 {
        width: 750px;
        border-bottom: 2px solid black;
        padding-left: 10px;
        padding-right: 10px;
    }

    .table-3 {
        width: 750px;
        padding-top: 10px;
        padding-left: 10px;
        padding-right: 10px;
    }

    .main {
        display: flex;
    }

    .main .main-isi {
        flex: 1;
        border: 1px solid black;
        padding-top: 10px;
        padding-bottom: 10px;
        padding-left: 10px;
        padding-right: 10px;
    }

    .table-4 {
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .end {
        padding-left: 10px;
        padding-right: 10px
    }
</style>

<body>
    <div class="container">
        <div class="kop">
            <table class="table-1">
                <tr>
                    <td><img src="{{ asset('img/logo/logo.png') }}" alt="UIN STS JAMBI"></td>
                    {{-- <td style="width: 20px;"></td> --}}

                    <td class="tengah">
                        <div class="tengah">
                            <h3>PERCETAKAN MERAPI</h3>
                            <P>Jl. Selamet Riyadi, RT.04/RW.RT.04, Legok,
                                14
                                Kecamatan. Telanaipura, Kota Jambi.</P>
                        </div>
                    </td>
                    {{-- <td><img src="{{ asset('img/logo_fst.jpeg') }}" alt="UIN STS JAMBI"></td> --}}
                </tr>
            </table>
            <center>
                <h2 class="text-1" style="padding-top: 10px;">Struk Pembelian</h2>
            </center>
        </div>

        <!-- LEMBAR ATAS -->
        <div class="isi">
            {{-- <table class="table-2" style="padding-top: 5px; padding-bottom: 5px;">
                <tr>
                    <th width="50%"></th>
                    <th width="50%"></th>
                </tr>

                <tr>
                    <td>Indek Berkas : {{ $disposisi->indek_berkas }}</td>
                    <td>Kode : {{ $disposisi->kode_klasifikasi_arsip }}</td>
                </tr>
            </table> --}}

            <table class="table-3">
                <tr>
                    <th width="20%"></th>
                    <th width="3%"></th>
                    <th width="77%"></th>
                </tr>

                <tr>
                    <td>Nama Costumer</td>
                    <td>:</td>
                    {{-- <td>{{ $disposisi->tanggal ? date('d-m-Y', strtotime($disposisi->tanggal)) : '' }}</td> --}}
                    <td>{{ 'Bambang' }}</td>
                </tr>

                <tr>
                    <td>No Hp</td>
                    <td>:</td>
                    {{-- <td>{{ $disposisi->suratMasuk->asal_surat }}</td> --}}
                    <td>{{ '082387120434' }}</td>
                </tr>


                <tr>
                    <td>Tanggal</td>
                    <td>:</td>
                    <td>{{ date('d-m-Y') }}</td>
                </tr>


                <tr>
                    <td>Nama Produk</td>
                    <td>:</td>
                    {{-- <td>{!! $disposisi->suratMasuk->isi_ringkas !!}</td> --}}
                    <td>{{ 'PENA' }}</td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td>:</td>
                    {{-- <td>{!! $disposisi->suratMasuk->isi_ringkas !!}</td> --}}
                    <td>{{ 2000 }}</td>
                </tr>

                <tr>
                    <td>Jumlah</td>
                    <td>:</td>
                    <td>{{ 10 }}</td>
                </tr>

                <tr>
                    <td>Total</td>
                    <td>:</td>
                    <td>{{ 20000 }}</td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>:</td>
                    <td>{{ 'Lunas' }}</td>
                </tr>

            </table>



        </div>

    </div>

</body>

</html>
