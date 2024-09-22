<?php

use App\Http\Controllers\LoginCtrl;
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

Route::match(['GET', 'POST'],'/login/{userType}', [LoginCtrl::class,'login'])->name('login');

Route::get('/', function () {
    return view('auth.chooseLogin');
});

Route::get('/login/{userType}', [LoginCtrl::class, 'index'])->name('login-type');


Route::group(['middleware' => 'auth'], function() {

    //student routes
    Route::middleware(['checkRole:student'])->group(function() {
        Route::get('/student', function(){
            return view('layout.student');
        });
    });

     //parents routes
    Route::middleware(['checkRole:parents'])->group(function() {
        Route::get('/parents', function(){
            dd('parents');
        });
    });

     //admin routes
    Route::middleware(['checkRole:admin'])->group(function() {
        Route::get('/admin', function(){
            return view('layout.student');
        });
        
    });

     //faculty routes
    Route::middleware(['checkRole:faculty'])->group(function() {
        Route::get('/faculty', function(){
            dd('faculty');
        });
       
    });

});
