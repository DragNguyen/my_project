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
Route::get('/test', function() {
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
    Route::resource('product_restore', 'Admin\Restore\ProductRestoreController', ['only' => ['index', 'store']]);

    /*
     * Supplier
     * */
    Route::resource('supplier', 'Admin\SupplierController');
    Route::resource('supplier_restore', 'Admin\Restore\SupplierRestoreController', ['only' => ['index', 'store']]);

    /*
     * Order
     * */
    Route::resource('order', 'Admin\OrderController');
    Route::resource('order_restore', 'Admin\Restore\OrderRestoreController', ['only' => ['index', 'store']]);
    Route::get('order/destroy/{id}', 'Admin\OrderController@orderDestroy')->name('order_destroy');
    Route::get('order/approve/{id}', 'Admin\OrderController@orderApprove')->name('order_approve');

    /*
     * Sales off
     * */
    Route::resource('sales_off', 'Admin\SalesOffController');
    Route::resource('sales_off_product', 'Admin\SalesOffProduct');

    /*
     * Goods receipt note - Nhap hang
     * */
    Route::resource('goods_receipt_note', 'Admin\GoodsReceiptNoteController');
    Route::resource('goods_receipt_note_restore', 'Admin\Restore\GoodsReceiptNoteRestoreController',
        ['only' => ['index', 'store']]);
    Route::resource('goods_receipt_note_product', 'Admin\GoodsReceiptNoteProductController');

    /*
     * Customer
     * */
    Route::resource('customer', 'Admin\CustomerController');


    /*
     *  Employees
     * */
    Route::resource('employee', 'Admin\EmployeeController');


    /*
     *  My self
     * */
    Route::post('my_self/change_avatar/{id}', 'Admin\AdminController@updateAvatar')->name('update_avatar');
    Route::post('my_self/change_password/{id}', 'Admin\AdminController@updatePassword')->name('update_password');
});