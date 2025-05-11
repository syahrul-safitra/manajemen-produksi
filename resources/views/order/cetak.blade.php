<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            /* height: 100vh; */
        }

        .container {
            width: 1000px;
            margin: 0 auto;
        }

        .kopsurat {
            padding: 20px 20px 5px 20px;
            display: flex;
            justify-content: center;
        }

        .kopsurat img {
            width: 65px;
        }

        .table-1 {
            padding: 3px;
            /* width: 100%; */
            /* border-bottom: 5px solid black; */
        }

        .tengah {
            text-align: center;
            padding: 0 20px;
        }

        .garis {
            width: 100%;
            height: 3px;
            background-color: black;
            margin-bottom: 5px;
        }

        .main {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .main th,
        .main td {
            padding: 5px;
        }

        .main .no {
            text-align: center;
            /* background-color: aqua; */
        }
    </style>
</head>

<body>

    <div class="container " style="margin-top: 10px">

        <div class="kopsurat">
            <table class="table-1">
                <tr>
                    <td>
                        <img src="{{ asset('img/logo/logo.png') }}" alt="" />
                    </td>

                    <td class="tengah">
                        <h4>Percetakan Merapi</h4>
                        <P>Jl. Selamet Riyadi, RT.04/RW.RT.04, Legok,
                            14
                            Kecamatan. Telanaipura, Kota Jambi. </P>
                    </td>
                </tr>
            </table>
        </div>

        <div class="garis">
        </div>


        <!-- table content -->
        <div class="content">

            <center>

                <h3 style="margin-top: 10px">Laporan Pesanan</h3><br>
                <h4>Periode {{ date('d-m-Y', strtotime($tanggal_awal)) }} -
                    {{ date('d-m-Y', strtotime($tanggal_akhir)) }}</h4>
            </center>
            <br>

            <div class="garis">
            </div>

            <table class="main" border="1" bordercollapse="collapse">
                <tr>
                    <th>No</th>
                    <th>Nama Costumer</th>
                    <th>No HP</th>
                    <th>Nama Barang</th>
                    <th>Tanggal</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>

                @php
                    $sumTotal = 0;
                @endphp
                @foreach ($data as $d)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $d->nama_costumer }}</td>
                        <td>{{ $d->no_hp }}</td>
                        <td>{{ $d->nama_produk }}</td>
                        <td>{{ date('d-m-Y', strtotime($d->tanggal_pesanan)) }}</td>
                        <td>{{ $d->produk->harga }}</td>
                        <td>{{ $d->jumlah }}</td>

                        @php
                            $hasil_rupiah = 'Rp ' . number_format($d->total, 0, ',', '.');
                            $sumTotal += $d->total;
                        @endphp
                        <td>{{ $hasil_rupiah }}</td>
                        <td>{{ $d->status }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td>Total : </td>
                    <td>{{ 'Rp ' . number_format($sumTotal, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
    </div>

</body>

</html>
