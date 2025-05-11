<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('order.index', [
            'orders' => Order::with('produk')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order.create', [
            'products' => DB::table('stoks')->select('nama_produk', DB::raw('SUM(jumlah) as total'))->groupBy('nama_produk')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_costumer' => 'required|max:200',
            'no_hp' => 'required|max:15',
            'nama_produk' => 'required',
            'tanggal_pesanan' => 'required',
            'jenis_pesanan' => 'required',
            'jumlah' => 'required',
            'total' => 'required', 
            'status' => 'required', 
        ]);

        Order::create($validated);

        return redirect('view-product')->with('success', 'Berhasil menambahkan pesanan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {

        // $product = Product::where('nama', '=', $order->nama_produk)->first();

        // $stok = DB::table('stoks')->select('nama_produk', DB::raw('SUM(jumlah) as total'))->where('nama_produk', '=', $order->nama_produk)->groupBy('nama_produk')->first();

        $product = Product::where('nama', '=', $order->nama_produk)->first();
        $stokProduk = DB::table('stoks')->select('nama_produk', DB::raw('SUM(jumlah) as total'))->where('nama_produk', '=', $order->nama_produk)->groupBy('nama_produk')->first();

        $produkTerjual = DB::table('orders')->select('nama_produk', DB::raw('SUM(jumlah) as total'))->where('nama_produk', '=', $order->nama_produk)->groupBy('nama_produk')->first();

        $sisaProduct = $stokProduk->total;

        if ($produkTerjual) {
            $sisaProduct -= $produkTerjual->total;
        }
        
        // return $sisaProduct;

        return view('order.edit ', [
            'product' => $product,
            'stokProduct' => $sisaProduct,
            'order' => $order
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'nama_costumer' => 'required|max:200',
            'no_hp' => 'required|max:15',
            'nama_produk' => 'required',
            'tanggal_pesanan' => 'required',
            'jenis_pesanan' => 'required',
            'jumlah' => 'required',
            'total' => 'required', 
            'status' => 'required', 
        ]);
        
        $order->update($validated);

        return redirect('order')->with('success', 'Berhasil mengupdate pesanan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return back()->with('success', 'Berhasil menghapus data');
    }

    public function order($data) {
        $product = Product::where('nama', '=', $data)->first();
        $stokProduk = DB::table('stoks')->select('nama_produk', DB::raw('SUM(jumlah) as total'))->where('nama_produk', '=', $data)->groupBy('nama_produk')->first();

        $produkTerjual = DB::table('orders')->select('nama_produk', DB::raw('SUM(jumlah) as total'))->where('nama_produk', '=', $data)->groupBy('nama_produk')->first();

        $sisaProduct = $stokProduk->total;
        if ($produkTerjual) {
            $sisaProduct -= $produkTerjual->total;
        } 

        return view('order.create', [
            'product' => $product,
            'stokProduct' => $sisaProduct
        ]);
        
    }

    public function cetak(Request $request) {
        $data = Order::with('produk')->whereBetween('tanggal_pesanan', [$request->tanggal_awal, $request->tanggal_akhir])->get();

        return view('order.cetak', [
            'data' => $data,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir
        ]);
    }
}
