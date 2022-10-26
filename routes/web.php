<?php

use App\Http\Controllers\User;
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

Route::get("/login", [User::class, 'index']);
Route::post("/auth-user", [User::class, 'auth']);
Route::get("/users", [User::class, 'index'])->name("users");
Route::get("/users/add", [User::class, 'create'])->name("add-user");
Route::post("/users/store", [User::class, 'store'])->name("store-user");
Route::get("/users/edit/{id}", [User::class, 'show'])->name("edit-user")->where("id", "[0-9]+");
Route::post("/users/update/{id}", [User::class, 'update'])->name("update-user")->where("id", "[0-9]+");
Route::get("users/delete/{id}", [User::class, 'destroy'])->name("delete-user")->where("id", '[0-9]+');
Route::get('/', function () {
    return view('layouts.dashboard');
})->name("dashboard");
Route::view("/orders", 'layouts.orders')->name("orders");
