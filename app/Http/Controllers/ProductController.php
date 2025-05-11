<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Stok;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('produk.index', [
            'products' => Product::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:200|unique:products',
            'harga' => 'required|min:1|numeric'
        ]);

        Product::create($validated);

        return redirect('produk')->with('success', 'Berhasil menambahkan produk');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $produk)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $produk)
    {
        return view('produk.edit', [
            'produk' => $produk
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $produk)
    {
        $rules = [
            'nama' => 'required|max:200',
            'harga' => 'required|min:1|numeric'
        ];

        if ($request->nama != $produk->nama) {
            $rules['nama'] = 'required|max:200|unique:products';
        }

        $validated = $request->validate($rules);

        $produk->update($validated);

        return redirect('produk')->with('success', 'Berhasil mengupdate data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $produk)
    {
        $produk->delete();

        return back()->with('success')->with('success', 'Berhasil menghapus data');
        
    }

    public function view() {
     
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
                $getSisaProduk[$i]['sisa'] = $produk[$i]->jumlah;
            }
        }

        return view('stok.opname', [
            'products' => $getSisaProduk
        ]);
        
        // return view('produk.view', [
        //     'products' => DB::table('stoks')->select('nama_produk', DB::raw('SUM(jumlah) as total'))->groupBy('nama_produk')->get()
        // ]);
    }
}
