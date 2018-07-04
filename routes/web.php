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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

//Route::get('/', function() {
//    return view('auth.admin-login');
//})->name('home');

/*
 * Customer
 * */
Route::get('/', function() {
    $products = \App\Product::paginate(24);
   return view('customer', compact('products'));
})->name('customer.index');

Route::get('/product/{slug}', function ($slug) {
    $product = \App\Product::where('slug', $slug)->first();

    return view('customer.product.index', compact('product'));
});

/*
 * Customer login / logout
 * */
Route::post('/login', 'Auth\CustomerLoginController@login')->name('customer.login.submit');
Route::get('/logout', 'Auth\CustomerLoginController@logout')->name('customer.logout');
Route::get('/register', 'Auth\CustomerLoginController@showRegisterForm')->name('customer.register.show');
Route::post('/register/submit', 'Auth\CustomerLoginController@register')->name('customer.register.submit');

/*
 * Shopping cart
 * */

Route::resource('shopping_cart', 'CartController');

Route::post('check_out_store', 'CartController@checkoutStore')->name('checkout.store');

Route::get('check_out_index', 'CartController@checkoutIndex')->name('checkout.index');

Route::post('cart_store', 'CartController@orderStore')->name('cart.store');

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

    Route::get('error', function () {
        return view('admin.404');
    });

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
     * Trademark
     * */
    Route::resource('trademark', 'Admin\TrademarkController');
    Route::resource('trademark_restore', 'Admin\Restore\TrademarkRestoreController', ['only' => ['index', 'store']]);

    /*
     * Product type
     * */
    Route::resource('product_type', 'Admin\ProductTypeController');
    Route::resource('product_type_restore', 'Admin\Restore\ProductTypeRestoreController', ['only' => ['index', 'store']]);

    /*
     * Product
     * */
    Route::resource('product', 'Admin\ProductController');
    Route::resource('product_restore', 'Admin\Restore\ProductRestoreController', ['only' => ['index', 'store']]);
    Route::get('product/change_price/{id}', 'Admin\ProductController@changePrice')->name('product_change_price');

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
    Route::get('order/change_status/{id}', 'Admin\OrderController@orderChangeStatus')->name('order_change_status');

    /*
     * Sales off
     * */
    Route::resource('sales_off', 'Admin\SalesOffController');
    Route::resource('sales_off_restore', 'Admin\Restore\SalesOffRestoreController', ['only' => ['index', 'store']]);
    Route::resource('sales_off_child', 'Admin\SalesOffChildController');
    Route::resource('sales_off_product', 'Admin\SalesOffProductController');

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
    Route::resource('employee', 'Admin\EmployeeController')
        ->middleware('employeeAu');
    Route::post('employee/{id}/reset_password', 'Admin\EmployeeController@resetPassword')->name('reset_password')
        ->middleware('employeeAu');
    Route::resource('employee_restore', 'Admin\Restore\EmployeeRestoreController', ['only' => ['index', 'store']])
        ->middleware('employeeAu');


    /*
     *  My self
     * */
    Route::post('my_self/change_avatar/{id}', 'Admin\AdminController@updateAvatar')->name('update_avatar');
    Route::post('my_self/change_password/{id}', 'Admin\AdminController@updatePassword')->name('update_password');
});