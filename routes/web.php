<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', function() {
    return view('auth.admin-login');
})->name('home');

Route::get('/admin/login',
    'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {

    Route::get('logout/', 'Auth\AdminLoginController@logout')->name('admin.logout');
    Route::get('/', 'Auth\AdminController@index')->name('admin.tong-quan');

    /*
     * Tong quan
     * */
    Route::resource('tong-quan', 'Admin\TongQuanController');

    /*
     * Thuong hieu
     * */
    Route::resource('thuong-hieu', 'Admin\ThuongHieuController');

    /*
     * Loai san pham
     * */
    Route::resource('loai-san-pham', 'Admin\LoaiSPController');

    /*
     * San pham
     * */
    Route::resource('san-pham', 'Admin\SanPhamController');

    /*
     * Nha cung cap
     * */
    Route::resource('nha-cung-cap', 'Admin\NhaCungCapController');

    /*
     * Don hang
     * */
    Route::resource('don-hang', 'Admin\DonHangController');

    /*
     * Khuyen mai
     * */
    Route::resource('khuyen-mai', 'Admin\KhuyenMaiController');

    /*
     * Nhap hang
     * */
    Route::resource('nhap-hang', 'Admin\NhapHangController');

    /*
     * Khach hang
     * */
    Route::resource('khach-hang', 'Admin\KhachHangController');


    /*
     *  Nhan vien
     * */
    Route::resource('nhan-vien', 'Admin\NhanVienController');


    /*
     *
     * */
});