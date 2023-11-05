<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\category\CategoryController;
use App\Http\Controllers\admin\category\SubCategoryController;
use App\Http\Controllers\admin\customers\AdminCustomerController;
use App\Http\Controllers\admin\dashboard\AdminController;
use App\Http\Controllers\admin\dashboard\AdminDashboardController;
use App\Http\Controllers\admin\fileManager\AdminManageFileController;
use App\Http\Controllers\admin\products\ProductController;
use App\Http\Controllers\admin\routes\AdminRouteController;
use App\Http\Controllers\admin\salesman\SalesmanController;
use App\Http\Controllers\admin\setting\WebSettingController;
use App\Http\Controllers\customer\CustomerDAshboardController;
use App\Http\Controllers\customer\CustomerLoginController;
use App\Http\Controllers\salesman\SalesmanDashboardController;
use App\Http\Controllers\salesman\SalesmanLoginController;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

// Customer Routes
Route::prefix('customer')->group(function () {
    Route::get('login', [customerLoginController::class, 'showLoginForm'])->name('customer.login');
    Route::post('login', [customerLoginController::class, 'login'])->name('customer.login.submit');
    Route::get('/register', [customerLoginController::class, 'showRegistrationForm'])->name('customer.register');
    Route::post('register', [customerLoginController::class, 'register'])->name('customer.register.submit');
    // Other customer routes...
});

Route::group(['prefix' =>'customer' , 'middleware'=>'auth'],function(){
    Route::get('/dashboard',[CustomerDAshboardController::class,'index'])->name('customer.dashboard');
    Route::get('/profile',[CustomerDAshboardController::class,'profile'])->name('customer.profile');
    Route::get('/edit',[CustomerDAshboardController::class,'edit'])->name('customer.edit');
    Route::get('/reset-password',[CustomerDAshboardController::class,'resetPassword'])->name('customer.reset-password');
    Route::post('/logout', [CustomerDAshboardController::class, 'logout'])->name('customer.logout');
});

// Salesman Routes
Route::prefix('salesman')->group(function () {
    Route::get('login', [SalesmanLoginController::class, 'showLoginForm'])->name('salesman.login');
    Route::post('login', [SalesmanLoginController::class, 'login'])->name('salesman.login.submit');
});

Route::group(['prefix' =>'salesman', 'middleware' => 'auth'], function(){
     Route::get('/dashboard',[SalesmanDashboardController::class,'index'])->name('salesman.dashboard');
     Route::get('/orders',[SalesmanDashboardController::class,'orders'])->name('salesman.orders');
     Route::get('/shop',[SalesmanDashboardController::class,'shop'])->name('salesman.shop');
     Route::get('/cart',[SalesmanDashboardController::class,'cart'])->name('salesman.cart');
     Route::get('/checkout',[SalesmanDashboardController::class,'checkout'])->name('salesman.checkout');
     Route::get('/my-routes',[SalesmanDashboardController::class,'routes'])->name('salesman.my_routes');
     Route::get('/profile',[SalesmanDashboardController::class,'profile'])->name('salesman.profile');
     Route::get('/payment',[SalesmanDashboardController::class,'payment'])->name('salesman.payment');
     Route::get('/reset-password',[SalesmanDashboardController::class,'resetPassword'])->name('salesman.reset-password');
     Route::post('/store-location', [SalesmanDashboardController::class, 'storeLocation'])->name('salesman.store.location');
     Route::post('/logout', [SalesmanDashboardController::class, 'logout'])->name('salesman.logout');

});

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminLoginController::class, 'loginAdmin'])->name('admin.login.submit');
});

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/salesmen', [SalesmanController::class, 'index'])->name('admin.salesmen');
    Route::get('/add/salesmen', [SalesmanController::class, 'salesmanForm'])->name('admin.salesman_form');
    Route::post('/store/salesman', [SalesmanController::class, 'storeSalesman'])->name('admin.store_salesman');
    Route::get('/salesman/profile/{slug}', [SalesmanController::class, 'salesmanProfile'])->name('admin.salesman_profile');
    Route::get('/salesman/edit/{salesmanId}', [SalesmanController::class, 'editFrom'])->name('admin.salesman.edit');
    Route::put('/salesman/update/{salesmanId}', [SalesmanController::class, 'updateSalesman'])->name('admin.salesman.update');
    Route::get('/salesman/routes/{salesmanId}',[SalesmanController::class,'routesForm'])->name('admin.routes_form');
    Route::get('/view/all/routes',[AdminRouteController::class,'index'])->name('admin.view_all_routes');
    Route::get('/add/generic/route',[AdminRouteController::class,'genericForm'])->name('admin.add_generic_route_form');
    Route::get('/assign/customers/to/route/{routeId}',[AdminRouteController::class,'addCustomersRouteFrom'])->name('admin.addd_customers_to_route_form');
    Route::post('/store/customers/to/route/{routeId}',[AdminRouteController::class,'storeCustomersToRoute'])->name('admin.store_customer_to_route');
    Route::get('/edit/customers/to/route/{routeId}',[AdminRouteController::class,'updaterouteForm'])->name('admin.edit_customers_to_route');
    Route::put('/update/customers/to/route/{routeId}',[AdminRouteController::class,'updateRouteCustomers'])->name('admin.update_customers_to_route');
    Route::get('/delete/route/{routeId}',[AdminRouteController::class,'deleteRoute'])->name('admin.delete_route');
    Route::post('/salesman/route/store',[SalesmanController::class,'createRoutes'])->name('admin.create_salesman_route');
    Route::get('/salesman/edit/route/{routeId}',[SalesmanController::class,'editRouteForm'])->name('admin.edit_salesman_route');
    Route::put('/salesman_route/update/{routeId}',[SalesmanController::class,'updateRoutes'])->name('admin.update_salesman_route');
    Route::get('/view/route/map/{routeId}',[AdminRouteController::class,'routeMap'])->name('admin.view_route_map');
    Route::get('/salesman/pay/edit/{salesmanId}',[SalesmanController::class,'editPayForm'])->name('admin.edit_salesman_pay');
    Route::put('/salesman/update/pay/{salesmanId}',[SalesmanController::class,'updatePay'])->name('admin.update_salesman_pay');
    Route::get('/salesman/deleted/{salesmanId}',[SalesmanController::class,'deleteSalesman'])->name('admin.deleted_salesman');
    Route::get('/all/orders',[AdminDashboardController::class,'orders'])->name('admin.all_orders');
    Route::get('/order/{orderId}',[AdminDashboardController::class,'orderDetail'])->name('admin.order_detail');
    Route::get('/settings',[WebSettingController::class,'index'])->name('admin.settings');
    Route::post('/logout', [AdminDashboardController::class, 'logout'])->name('admin.logout');

    // customers related routes //
    Route::get('/all/customers',[AdminCustomerController::class,'index'])->name('admin.view_all_customers');
    Route::get('/create/new/customer',[AdminCustomerController::class,'create'])->name('admin.customer_create');
    Route::post('/store/customer',[AdminCustomerController::class,'store'])->name('admin.store_new_customer');
    Route::get('/edit/customer/{id}',[AdminCustomerController::class,'edit'])->name('admin.edit_customer');
    Route::put('/customer/update/{id}', [AdminCustomerController::class, 'update'])->name('admin.customer_Update');
    Route::get('/customer/profile/{id}',[AdminCustomerController::class,'profile'])->name('admin.view_customer_profile');
    Route::get('/balance/sheet/of/customer/{id}',[AdminCustomerController::class,'balance'])->name('admin.view_customer_balance_sheet');
    Route::get('/customer/orders/{id}',[AdminCustomerController::class,'orders'])->name('admin.customer_orders');
    Route::get('/customer/order/detail/{orderId}',[AdminCustomerController::class,'orderDetail'])->name('admin.customer_order_detail');
    Route::get('/customer/transactions/{id}',[AdminCustomerController::class,'transactions'])->name('admin.customer_transactions');
    Route::get('/customer/map/{id}',[AdminCustomerController::class,'customerMap'])->name('admin.customer_map');

    //Category routes//
    Route::get('/categories',[CategoryController::class,'index'])->name('admin.categories');
    Route::get('/add/new/category',[CategoryController::class, 'create'])->name('admin.create_category_form');
    Route::post('/store/new/category',[CategoryController::class,'storeCategory'])->name('admin.store_category');
    Route::get('/edit/category/{slug}',[CategoryController::class, 'edit'])->name('admin.edit_category_form');
    Route::put('/update/existing/category/{slug}', [CategoryController::class, 'update'])->name('admin.update_category');
    //SubCategories//
    Route::get('/sub-categories',[SubCategoryController::class,'index'])->name('admin.sub_categories');
    Route::get('/add/sub-category',[SubCategoryController::class,'create'])->name('admin.sub_category_form');
    Route::post('/store/sub-category',[SubCategoryController::class,'store'])->name('admin.store_sub_category');
    Route::get('/edit/sub-category/{slug}',[SubCategoryController::class,'edit'])->name('admin.edit_sub_category_form');
    Route::put('/update/sub-catgeory/{slug}',[SubCategoryController::class,'update'])->name('admin.update_sub_category');
    //Products routes//
    Route::get('/products',[ProductController::class,'index'])->name('admin.products');
    Route::get('/add/product',[ProductController::class,'create'])->name('admin.product_create_form');
    Route::post('/store/product',[ProductController::class,'store'])->name('admin.store_product');
    Route::get('/edit/product/{productId}',[ProductController::class,'edit'])->name('admin.edit_product_form');
    Route::put('/update/product/{productId}',[ProductController::class,'update'])->name('admin.update_product');
    //Admins routes //
    Route::get('/administration',[AdminController::class,'index'])->name('admin.administration');
    Route::get('/administrator/create',[AdminController::class,'create'])->name('admin.administrator_create_form');
    Route::get('/administrator/{adminId}',[AdminController::class,'edit'])->name('admin.administrator_edit_form');
    Route::put('/administrator/update/{adminId}',[AdminController::class,'storeOrUpdate'])->name('admin.update_admin');
    Route::post('/administrator/store',[AdminController::class,'storeOrUpdate'])->name('admin.store_admin');
    //admin profile //
    Route::get('/profile',[AdminController::class,'profile'])->name('admin.profile');
    //manage files routes//
    Route::get('/file-manager',[AdminManageFileController::class,'index'])->name('admin.manage_files');
    Route::get('/folders/{folder}', [AdminManageFileController::class, 'showImages'])->name('folders.show');
    Route::post('/folders/{folder}/upload', [AdminManageFileController::class, 'uploadImages'])->name('folders.upload');



});
