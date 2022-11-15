<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RestaurentController;
use App\Http\Controllers\ReviewController;

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

Route::get('/', [HomeController::class, 'index']);

Auth::routes();

Route::get('home', [HomeController::class, 'loggedHome'])->name('home');
Route::get('admin-index', [AdminController::class, 'index'])->name('admin.index');
Route::get('users-list', [AdminController::class, 'usersList'])->name('users.list');

Route::resource('restaurent',RestaurentController::class);
Route::resource('review',ReviewController::class);

Route::get('my-reviews',[ReviewController::class,'myReviews'])->name('my_reviews');
Route::get('add-review/{id}', [ReviewController::class, 'addReview'])->name('add.review');
