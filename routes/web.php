<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SalesHistoryController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\SignUpController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'auth', 'ceklevel: admin, petugas'], function () {
	Route::get('/', [HomeController::class, 'home']);
	Route::get('mainMenu', [BarangController::class, 'mainMenu'])->name('mainMenu');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::post('/checkout', [SalesHistoryController::class, 'checkout']);
	Route::post('/checkoutdata', [SalesHistoryController::class, 'checkoutdata'])->name('checkoutdata');
});

Route::group(
	['middleware' => 'auth', 'ceklevel: admin'],
	function () {

		Route::get('/dashboardAdmin', [BarangController::class, 'index'])->name('dashboardAdmin');
		Route::get('/AddProduct', [BarangController::class, 'addProduct'])->name('addProduct');
		Route::post('/insertdata', [BarangController::class, 'insertdata'])->name('insertdata');


		Route::get('/edit/{id}', [BarangController::class, 'editdata'])->name('editdata');
		Route::post('/updatedata/{id}', [BarangController::class, 'updatedata'])->name('updatedata');
		Route::get('/delete/{id}', [BarangController::class, 'delete'])->name('delete');


		Route::get('histori', [SalesHistoryController::class, 'histori'])->name('histori');
		Route::get('/apus/{id}', [SalesHistoryController::class, 'apus'])->name('apus');


		Route::get('tables', [SignUpController::class, 'tables'])->name('tables');
		Route::get('/hapus/{id}', [SignUpController::class, 'hapus'])->name('hapus');
		Route::post('/inputdata', [SignUpController::class, 'inputdata'])->name('inputdata');
		Route::get('/static-sign-up', [SignUpController::class, 'create']);
		Route::post('/staticproses', [SignUpController::class, 'staticproses'])->name('staticproses');



		Route::get('/histori', [SalesHistoryController::class, 'histori'])->name('histori');
	}
);


Route::group(['middleware' => 'guest'], function () {
	Route::get('/register', [RegisterController::class, 'create']);
	Route::post('/register', [RegisterController::class, 'store']);
	Route::get('/login', [SessionsController::class, 'create'])->name('LoginSession');
	Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');
});

Route::get('/login', function () {
	return view('session/login-session');
})->name('login');
