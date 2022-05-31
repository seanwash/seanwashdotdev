<?php

use Illuminate\Support\Facades\Route;
use App\Models\Matter;
use App\Models\MatterType;

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
    return view('home');
})->name('home');

Route::get('/uses', function () {
    return view('uses', [
        'tools' => Matter::whereType(MatterType::TOOL)->with('tags')->get()
    ]);
})->name('uses');

Route::get('/bookmarks', function () {
    return view('bookmarks', [
        'bookmarks' => Matter::whereType(MatterType::BOOKMARK)->with('tags')->get()
    ]);
})->name('bookmarks');

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth.basic'])
    ->group(function () {
        Route::get('/', function () {
            return view('admin.index', ['matter' => Matter::latest()->get()]);
        })->name('home');
    });

