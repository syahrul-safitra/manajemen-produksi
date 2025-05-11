<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Product;
use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('stok.index', [
            'stokProducts' => Stok::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('stok.create', [
            'products' => Product::latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required',
            'jumlah' => 'required|min:1'
        ]);

        Stok::create($validated);

        return redirect('unit-produk')->with('success', 'Berhasil menginput data');
    }

    /**
     * Display the specified resource.
     */
    public function show(Stok $unit_produk)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stok $unit_produk)
    {
        return view('stok.edit', [
            'stok' => $unit_produk,
            'products' => Product::latest()->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stok $unit_produk)
    {
        $validated = $request->validate([
            'nama_produk' => 'required',
            'jumlah' => 'required|min:1'
        ]);

        $unit_produk->update($validated);

        return redirect('unit-produk')->with('success', 'Berhasil mengupdate data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stok $unit_produk)
    {
        $unit_produk->delete();

        return back()->with('success', 'Berhasil menghapus data');
    }

    public function stok() {
        $produk = Stok::select('nama_produk', DB::raw('SUM(jumlah) as jumlah'))->groupBy('nama_produk')->get();

        $produkTerjual = Order::select('nama_produk', DB::raw('SUM(jumlah) as jumlah'))->groupBy('nama_produk')->get();

        
        $getIndexProdukTerjual = [];

        $getSisaProduk = [];

        foreach($produkTerjual as $p) {
            $getIndexProdukTerjual[] = $p->nama_produk;
        }

        for($i = 0; $i < count($produk); $i++) {
            $getIndex = array_search($produk[$i]['nama_produk'], $getIndexProdukTerjual);
            
            if ($getIndex > -1) {
                $getSisaProduk[$i]['nama_produk'] = $produk[$i]->nama_produk;
                $getSisaProduk[$i]['sisa'] = $produk[$i]->jumlah - $produkTerjual[$getIndex]['jumlah'];
            } else {
                $getSisaProduk[$i]['nama_produk'] = $produk[$i]->nama_produk;
                $getSisaProduk[$i]['jumlah'] = $produk[$i]->jumlah;
            }
        }

        return view('stok.opname', [
            'products' => $getSisaProduk
        ]);

    }
}
