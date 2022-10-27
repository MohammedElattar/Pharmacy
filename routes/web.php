<?php

use App\Http\Controllers\Logs;
use App\Http\Controllers\Partners;
use App\Http\Controllers\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\medicine_categories;
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
