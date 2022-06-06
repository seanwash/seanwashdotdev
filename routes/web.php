<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Matter;
use App\Models\MatterType;
use Illuminate\Support\Str;

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
        Route::get('/', function (Request $request) {
            $matter = Matter::latest()
                ->when($request->input('type'), function (Builder $query) use ($request) {
                    return $query->where('type', '=', $request->input('type'));
                })
                ->get();

            return view('admin.index', ['matter' => $matter]);
        })->name('home');

        Route::get('/matter/create', function () {
            return view('admin.matter.create', []);
        })->name('matter.create');

        Route::post('/matter', function (Request $request) {
            $validated = $request->validate([
                'type' => ['required', "in:".implode(",", MatterType::values())],
                'name' => 'required',
                'external_url' => ['nullable', 'url'],
                'content' => 'nullable',
                'public_at' => 'nullable|date',
            ]);

            $validated['slug'] = Str::slug($validated['name']);

            Matter::create($validated);

            return redirect()->to('admin');
        })->name('matter.store');

        Route::get('/matter/{matter}', function (Matter $matter) {
            return view('admin.matter.edit', ['matter' => $matter]);
        })->name('matter.edit');

        Route::put('matter/{matter}', function (Request $request, Matter $matter) {
            $validated = $request->validate([
                'type' => ['required', "in:".implode(",", MatterType::values())],
                'name' => 'required',
                'external_url' => ['nullable', 'url'],
                'content' => 'nullable',
                'public_at' => 'nullable|date',
            ]);

            $validated['slug'] = Str::slug($validated['name']);

            $matter->update($validated);

            return redirect()->to('admin');
        })->name('matter.update');

        Route::delete('/matter/{matter}', function (Request $request, Matter $matter) {
            $matter->delete();

            return redirect()->to('admin');
        })->name('matter.destroy');
    });

