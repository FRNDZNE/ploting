<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Events\KapalEvent;
use App\Models\Sandar;

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

Auth::routes();

Route::get('/templatebackend',function(){
    return view('layouts.backend.app');
});
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
    });
});

Route::get('event', function(){
    $kapal = Sandar::with('kapal')->get();
    broadcast(new KapalEvent($kapal));
});
