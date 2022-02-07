<?php

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

Route::get('/', function () {
    return view('welcome');
});


require __DIR__.'/auth.php';

Route::middleware(['auth'])->group(function () {
    Route::get('/orphan/dashboard', function () {
        $mySponsors=\App\Models\User::with('sponsors')->where('id',auth()->id())->first()->sponsors;
        return view('orphans.orphan-dashboard',[
            'mySponsors'=>$mySponsors
        ]);
    })->middleware('sinDetails')->name('orphan.dashboard');
    Route::get('/sponsor/dashboard', function () {
        $ids=\App\Models\SponsorOrphan::where('sponsor_id',\Illuminate\Support\Facades\Auth::id())->pluck('orphan_id');
        $orphans=\App\Models\User::whereHas('details')->whereNotIn('id',$ids)->where('type','orphan')->get();
        $myOrphans=\App\Models\User::with('orphans')->where('id',auth()->id())->first()->orphans;
        return view('sponsors.sponsor-dashboard',['orphans'=>$orphans,'myOrphans'=>$myOrphans]);
    })->middleware('isSponsor')->name('sponsor.dashboard');
    Route::resource('details','App\Http\Controllers\UserController')->only(['create','store']);
    Route::post('add/wallet',[\App\Http\Controllers\UserController::class,'addWallet'])->name('add.wallet');
    Route::post('add/orphan/bail',[\App\Http\Controllers\SponsorController::class,'store'])->name('add.orphan');
    Route::get('remove/orphan/{id}',[\App\Http\Controllers\SponsorController::class,'destroy'])->name('remove.orphan');
//    Route::get('details',[\App\Http\Controllers\UserController::class,'create'])->name('details.create');
//    Route::post('details',[\App\Http\Controllers\UserController::class,'store'])->name('details.store');
    });
