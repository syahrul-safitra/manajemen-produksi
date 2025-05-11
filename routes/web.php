<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\UserController;

use App\Models\Order;
use App\Models\Stok;
use App\Models\User;

use Illuminate\Support\Facades\Route;
use function PHPUnit\Framework\isNull;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    $produk = Stok::select('nama_produk', DB::raw('SUM(jumlah) as jumlah'))->groupBy('nama_produk')->get();

    $produkTerjual = Order::select('nama_produk', DB::raw('SUM(jumlah) as jumlah'))->groupBy('nama_produk')->get();

        
    $getIndexProdukTerjual = [];

    $getSisaProduk = 0;

    foreach($produkTerjual as $p) {
        $getIndexProdukTerjual[] = $p->nama_produk;
    }

    for($i = 0; $i < count($produk); $i++) {
        $getIndex = array_search($produk[$i]['nama_produk'], $getIndexProdukTerjual);
            
        if ($getIndex > -1) {
            $getSisaProduk += $produk[$i]->jumlah - $produkTerjual[$getIndex]['jumlah'];
        } else {
            $getSisaProduk += $produk[$i]->jumlah;
        }
    }

    $get = Order::select(DB::raw('SUM(jumlah) as jumlah'))->whereYear('tanggal_pesanan', date('Y'))->whereMonth('tanggal_pesanan', 4)->first();

    // mendapatkan data total pendapatan perbulan :
    $dataPendapatanPerbulan = [];
    
    for ($i = 1; $i <= 12; $i++) {
        $get = Order::select(DB::raw('SUM(total) as jumlah'))->whereYear('tanggal_pesanan', date('Y'))->whereMonth('tanggal_pesanan', $i)->first();

        // jika get ada :
        if ($get->jumlah) {
            $dataPendapatanPerbulan[] = $get->jumlah;
        } else {
            $dataPendapatanPerbulan[] =  0;
        }
    }

    return view('welcome', [
        'totalPendapatanBlnIni' => Order::whereYear('tanggal_pesanan', date('Y'))
        ->whereMonth('tanggal_pesanan', date('m'))
        ->sum('total'),

        'totalProdukTerjualBlnIni' => Order::whereYear('tanggal_pesanan', date('Y'))
        ->whereMonth('tanggal_pesanan', date('m'))
        ->sum('jumlah'),

        'totalStokProduk' => $getSisaProduk,

        'totalPengguna' => User::where('role', '!=', 'admin')->count(),

        'dataPendapatanPerbulan' => $dataPendapatanPerbulan
    ]);
})->middleware('auth');

Route::resource('produk', ProductController::class)->middleware('auth');

Route::resource('unit-produk', StokController::class)->middleware('auth');

Route::resource('order', OrderController::class)->middleware('auth');

Route::get('view-product', [ProductController::class, 'view'])->middleware('auth');

Route::get('view-product/{data}', [OrderController::class, 'order'])->middleware('auth');

Route::get('stok-produk', [StokController::class, 'stok'])->middleware('auth');

Route::post('cetak-order', [OrderController::class, 'cetak'])->middleware('auth');

Route::post('logout', function() {
    return "HOLlaa";
})->middleware('auth');

Route::resource('user', UserController::class)->middleware('auth');

Route::get('login', [AuthController::class, 'index'])->middleware('guest')->name('login');

Route::post('login', [AuthController::class, 'auth'])->middleware('guest');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');