<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransportirController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PenawaranHargaController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PengirimanController;

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
    // return view('welcome');
    return redirect('/login');
});

// auth
route::get('/login', [AuthController::class, 'login'])->middleware('guest')->name('login');
route::post('/login', [AuthController::class, 'tryLogin'])->middleware('guest');
route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');
// profile
route::get('/profil', [AuthController::class, 'profil'])->middleware('auth');
route::put('/profil', [AuthController::class, 'ubahProfil'])->middleware('auth');

// dashboard
route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// user
route::get('/user', [UserController::class, 'index']);
route::post('/user', [UserController::class, 'store']);
route::delete('/user', [UserController::class, 'destroy']);
route::put('/user', [UserController::class, 'update']);

// produk
route::get('/produk', [ProdukController::class, 'index']);
route::post('/produk', [ProdukController::class, 'store']);
route::delete('/produk', [ProdukController::class, 'destroy']);
route::put('/produk', [ProdukController::class, 'update']);

// customer
route::get('/customer', [CustomerController::class, 'index']);
route::post('/customer', [CustomerController::class, 'store']);
route::delete('/customer', [CustomerController::class, 'destroy']);
route::put('/customer', [CustomerController::class, 'update']);

// transportir
route::get('/transportir', [TransportirController::class, 'index']);
route::post('/transportir', [TransportirController::class, 'store']);
route::delete('/transportir', [TransportirController::class, 'destroy']);
route::put('/transportir', [TransportirController::class, 'update']);

// orders
route::get('/order', [OrderController::class, 'index']);
route::post('/order', [OrderController::class, 'store']);
route::delete('/order', [OrderController::class, 'destroy']);
route::put('/order', [OrderController::class, 'update']);

// penawaran harga
route::get('/penawaranharga', [PenawaranHargaController::class, 'index']);
route::post('/penawaranharga', [PenawaranHargaController::class, 'store']);
route::delete('/penawaranharga', [PenawaranHargaController::class, 'destroy']);
route::put('/penawaranharga', [PenawaranHargaController::class, 'update']);

// purchase order
route::get('/purchaseorder', [PurchaseOrderController::class, 'index']);
route::post('/purchaseorder', [PurchaseOrderController::class, 'store']);
route::delete('/purchaseorder', [PurchaseOrderController::class, 'destroy']);
route::put('/purchaseorder', [PurchaseOrderController::class, 'update']);
route::post('/purchaseorder/kirim', [PurchaseOrderController::class, 'kirim']);
route::get('/purchaseorder/pengiriman', [PurchaseOrderController::class, 'pengiriman']);

// laporan
route::get('/order/laporan', [OrderController::class, 'laporan']);
route::get('/penawaranharga/laporan', [PenawaranHargaController::class, 'laporan']);
route::get('/purchaseorder/laporan', [PurchaseOrderController::class, 'laporan']);
route::get('/pengiriman/laporan', [PengirimanController::class, 'laporan']);
