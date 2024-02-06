<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Events\KapalEvent;
use App\Models\Sandar;
use App\Models\User;
use App\Models\Role;

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

Route::get('/',[DashboardController::class,'index'])->name('index');
Route::get('/2',[DashboardController::class,'index2'])->name('index2');

Auth::routes([
  'register' => false, // Registration Routes...
  'reset' => false, // Password Reset Routes...
  'verify' => false, // Email Verification Routes...
]);


Route::middleware('auth')->prefix('admin')->group(function(){
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');

    Route::prefix('data-kapal')->group(function(){
        // get method
        Route::get('/',[AdminController::class,'index'])->name('admin.index');
        Route::get('/create',[AdminController::class,'create'])->name('admin.create');
        Route::get('/edit/{id}',[AdminController::class,'edit'])->name('admin.edit');
        Route::get('/detail/{id}',[AdminController::class,'detail'])->name('admin.detail');
        Route::get('/history/',[AdminController::class,'history'])->name('admin.history');
        Route::get('/history/detail/{id}',[AdminController::class,'history_detail'])->name('admin.history.detail');
        // post method
        Route::post('/store',[AdminController::class,'store'])->name('admin.store');
        Route::post('/update/{id}',[AdminController::class,'update'])->name('admin.update');
        Route::post('/delete/{id}',[AdminController::class,'delete'])->name('admin.delete');
        Route::post('/restore/{id}',[AdminController::class,'restore'])->name('admin.restore');
        Route::post('/destroy/{id}',[AdminController::class,'destroy'])->name('admin.destroy');
        Route::post('/setketerangan',[AdminController::class,'setketerangan'])->name('admin.keterangan');
    });

    Route::prefix('user')->middleware('role:superadmin')->group(function(){
        Route::get('/',[UserController::class,'index'])->name('user.index');
        Route::post('/store',[UserController::class,'store'])->name('user.store');
        Route::post('/update',[UserController::class,'update'])->name('user.update');
        Route::post('/delete/{id}',[UserController::class,'delete'])->name('user.delete');
        
        Route::get('/history',[UserController::class,'history'])->name('user.history');
        Route::post('/restore/{id}',[UserController::class,'restore'])->name('user.restore');
        Route::post('/destroy/{id}',[UserController::class,'destroy'])->name('user.destroy');
    });
    
    Route::get('/profile',[UserController::class,'profile'])->name('user.profile');
    Route::post('/profile/update',[UserController::class,'profile_update'])->name('user.profile.update');
    
    
});
