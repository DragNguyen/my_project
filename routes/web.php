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

//Route::get('/', function() {
//    return view('auth.admin-login');
//})->name('home');

/*
 * Test
 * */
Route::get('/admin/test', function() {
   return view('admin.test');
});

/*
* Admin login
* */
Route::get('/admin/login',
    'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

/*
 * Admin group
 * */
Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function() {

    Route::get('logout/', 'Auth\AdminLoginController@logout')->name('admin.logout');

    /*
     * Dashboard
     * */
    Route::get('/', 'Auth\AdminController@index')->name('admin.tong-quan');

    /*
     * Dashboard
     * */
    Route::resource('dashboard', 'Admin\DashboardController');

    /*
     * Trademark - Thuong hieu
     * */
    Route::resource('trademark', 'Admin\TrademarkController');

    /*
     * Product type
     * */
    Route::resource('product_type', 'Admin\ProductTypeController');

    /*
     * Product
     * */
    Route::resource('product', 'Admin\ProductController');

    /*
     * Supplier
     * */
    Route::resource('supplier', 'Admin\SupplierController');

    /*
     * Order
     * */
    Route::resource('order', 'Admin\OrderController');

    /*
     * Sales off
     * */
    Route::resource('sales_off', 'Admin\SalesOffController');

    /*
     * Goods receipt note - Nhap hang
     * */
    Route::resource('goods_receipt_note', 'Admin\GoodsReceiptNoteController');

    /*
     * Customer
     * */
    Route::resource('/account/customer', 'Admin\CustomerController');


    /*
     *  Employees
     * */
    Route::resource('/account/employees', 'Admin\EmployeesController');


    /*
     *
     * */
});