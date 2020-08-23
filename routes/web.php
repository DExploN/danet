<?php

use App\Http\Controllers\Admin\CardController;
use Illuminate\Support\Facades\Auth;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes(['register' => false, 'reset' => false]);
Route::middleware(['auth'])->prefix('admin')->name('admin')->group(
    function () {
        Route::resource('cards', CardController::class);
    }
);
//Route::get('/home', 'HomeController@index')->name('home');
