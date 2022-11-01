<?php

use App\Http\Controllers\Ajax;
use App\Http\Controllers\Logs;
use App\Http\Controllers\Partners;
use App\Http\Controllers\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\medicine_categories;
use App\Http\Controllers\medicine_types;
use App\Http\Controllers\customers;
use App\Http\Controllers\products;
use App\Http\Controllers\receiving;
use App\Http\Controllers\sales;

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

Route::get("/login", [User::class, 'index']);
Route::post("/auth-user", [User::class, 'auth']);
// dashboard

Route::get('/', function () {
    return view('layouts.dashboard');
})->name("dashboard");


// users

Route::get("/users", [User::class, 'index'])->name("users");
Route::get("/users/add", [User::class, 'create'])->name("add-user");
Route::post("/users/store", [User::class, 'store'])->name("store-user");
Route::get("/users/edit/{id}", [User::class, 'show'])->name("edit-user")->where("id", "[0-9]+");
Route::post("/users/update/{id}", [User::class, 'update'])->name("update-user")->where("id", "[0-9]+");
Route::get("users/delete/{id}", [User::class, 'destroy'])->name("delete-user")->where("id", '[0-9]+');

/* Partners */

// show partners

Route::get("/partners", [Partners::class, 'index'])->name("partners");

// add partner

Route::get("/partners/add", [Partners::class, 'create'])->name("add-partner");
Route::post("/partners/store", [Partners::class, 'store'])->name("store-partner");

// edit partner

Route::get("/partners/edit/{id}", [Partners::class, 'show'])->name("edit-partner")->where("id", "[0-9]+");;
Route::post("/partners/edit/{id}", [Partners::class, 'update'])->name("update-partner")->where("id", "[0-9]+");;

// delete partner
Route::get("/partners/delete/{id}", [Partners::class, 'destroy'])->where("id", '[0-9]+')->name("delete-partner");

/* Sales */

// show sales

Route::get("/logs", [Logs::class, 'index'])->name("logs");
Route::get("/logs/delete/{id}", [Logs::class, 'delete'])->name("delete-log")->where("id", "[0-9]+");
Route::get("/logs/delete_all", [Logs::class, 'deleteAll'])->name("delete-logs");

// orders

Route::view("/orders", 'layouts.orders')->name("orders");

/* Medicine Categories */

Route::get("/medicine_categories", [medicine_categories::class, 'index'])->name("medicine_categories");
Route::get("/medicines_categories/add", [medicine_categories::class, 'create'])->name("add-categories");
Route::post("/medicines_categories/store", [medicine_categories::class, 'store'])->name("store-categories");
Route::get("/medicines_categories/edit/{id}", [medicine_categories::class, 'show'])->name("edit-categories");
Route::post("/medicines_categories/update/{id}", [medicine_categories::class, 'update'])->name("update-categories");
Route::get("/medicines_categories/delete/{id}", [medicine_categories::class, 'destroy'])->name("delete-categories");

/* Customers */

Route::get("/customers", [customers::class, 'index'])->name("customer");
Route::get("/customers/add", [customers::class, 'create'])->name("add-customer");
Route::post("/customers/store", [customers::class, 'store'])->name("store-customer");
Route::get("/customers/edit/{id}", [customers::class, 'show'])->name("edit-customer");
Route::post("/customers/update/{id}", [customers::class, 'update'])->name("update-customer");
Route::get("/customers/delete/{id}", [customers::class, 'destroy'])->name("delete-customer");

/* Medicine Types */

Route::get("/types", [medicine_types::class, 'index'])->name("type");
Route::get("/types/add", [medicine_types::class, 'create'])->name("add-type");
Route::post("/types/store", [medicine_types::class, 'store'])->name("store-type");
Route::get("/types/edit/{id}", [medicine_types::class, 'show'])->name("edit-type");
Route::post("/types/update/{id}", [medicine_types::class, 'update'])->name("update-type");
Route::get("/types/delete/{id}", [medicine_types::class, 'destroy'])->name("delete-type");


/* Inventory */


/* Products */

Route::get("/products", [products::class, 'index'])->name("product");
Route::get("/products/add", [products::class, 'create'])->name("add-product");
Route::post("/products/store", [products::class, 'store'])->name("store-product");
Route::get("/products/edit/{id}", [products::class, 'show'])->name("edit-product")->where("id", '[0-9]+');
Route::post("/products/update/{id}", [products::class, 'update'])->name("update-product")->where("id", '[0-9]+');
Route::get("/products/delete/{id}", [products::class, 'destroy'])->name("delete-product")->where("id", '[0-9]+');

/* Sales */

Route::get("/receiving", [receiving::class, 'index'])->name("receiving");
Route::get("/receiving/add", [receiving::class, 'create'])->name("add-receiving");
Route::post("/receiving/store", [receiving::class, 'store'])->name("store-receiving");
Route::get("/receiving/edit/{id}", [receiving::class, 'show'])->name("edit-receiving")->where("id", '[0-9]+');
Route::post("/receiving/update/{id}", [receiving::class, 'update'])->name("update-receiving")->where("id", '[0-9]+');
Route::get("/receiving/delete/{id}", [receiving::class, 'destroy'])->name("delete-receiving")->where("id", '[0-9]+');

/* Receiving */

Route::get("/sales", [sales::class, 'index'])->name("sale");
Route::get("/sales/add", [sales::class, 'create'])->name("add-sale");
Route::post("/sales/store", [sales::class, 'store'])->name("store-sale");
Route::get("/sales/edit/{id}", [sales::class, 'show'])->name("edit-sale")->where("id", '[0-9]+');
Route::post("/sales/update/{id}", [sales::class, 'update'])->name("update-sale")->where("id", '[0-9]+');
Route::get("/sales/delete/{id}", [sales::class, 'destroy'])->name("delete-sale")->where("id", '[0-9]+');

// Ajax Call

Route::post("/ajax/{obj}/{operation}", [Ajax::class, 'process'])->name("ajx")->where([
    "obj" => '[a-z A-z]+',
    'operation' => '[a-zA-z]+',
]);
