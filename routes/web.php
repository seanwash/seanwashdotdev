<?php

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Models\Matter;
use App\Models\MatterType;
use App\Models\Tag;

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

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }

    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required']
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        return redirect()->intended(
            route('admin.home')
        );
    }

    return back()
        ->withErrors([
            'email' => 'The provided email or password are invalid.'
        ])
        ->onlyInput('email');
})->name('login.store');

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('home');
})->middleware('auth')->name('logout');

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
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/', function (Request $request) {
            $matter = Matter::latest()
                ->when($request->input('keyword'), function (Builder $query) use ($request) {
                    return $query->where('name', 'like', "%{$request->input('keyword')}%");
                })
                ->when($request->input('type'), function (Builder $query) use ($request) {
                    return $query->where('type', $request->input('type'));
                })
                ->get();

            return view('admin.index', ['matter' => $matter, 'keyword' => $request->query('keyword')]);
        })->name('home');

        Route::get('/matter/create', function () {
            return view('admin.matter.create', ['tags' => Tag::all()]);
        })->name('matter.create');

        Route::get('/matter/metadata', function (Request $request) {
            $validated = $request->validate([
                'url' => ['required', 'url']
            ]);

            $response = Http::get($validated['url']);

            $dom = new DomDocument();
            $dom->loadHTML($response->body(), LIBXML_NOERROR);
            $xpath = new DOMXPath($dom);

            $titleElList = $xpath->query('/html/head/title');
            $title = collect($titleElList)->map(function (DomElement $element) {
                return [$element->nodeName => $element->nodeValue];
            });

            $metaElList = $xpath->query('/html/head/meta[starts-with(@name, \'description\')]');
            $meta = collect($metaElList)->map(function (DomElement $element) {
                return [$element->getAttribute('name') => $element->getAttribute('content')];
            });

            // TODO: Flatmap here must not be necessary.
            $values = $title->concat($meta)->flatMap(fn(array $value) => $value);

            return response()->json($values);
        })->name('matter.metadata');

        Route::post('/matter', function (Request $request) {
            $request->merge(['slug' => Str::slug($request->name)]);

            $validated = $request->validate([
                'type' => ['required', "in:".implode(",", MatterType::values())],
                'name' => ['required'],
                'slug' => ['unique:matters,slug'],
                'external_url' => ['nullable', 'url'],
                'content' => ['nullable'],
                'public_at' => ['nullable', 'date'],
                'tags' => ['nullable', 'array']
            ]);

            $matter = Matter::create($validated);

            if ($validated['tags']) {
                $matter->tags()->sync($validated['tags']);
            }

            return redirect()->to('admin');
        })->name('matter.store');

        Route::get('/matter/{matter}/edit', function (Matter $matter) {
            $matter->load('tags');

            return view('admin.matter.edit', ['matter' => $matter, 'tags' => Tag::all()]);
        })->name('matter.edit');

        Route::put('matter/{matter}', function (Request $request, Matter $matter) {
            // TODO: Replace with $request->getters.
            $validated = $request->validate([
                'type' => ['required', "in:".implode(",", MatterType::values())],
                'name' => ['required'],
                'external_url' => ['nullable', 'url'],
                'content' => ['nullable'],
                'public_at' => ['nullable', 'date'],
                'tags' => ['nullable', 'array']
            ]);

            $validated['slug'] = Str::slug($validated['name']);

            $matter->update($validated);
            $matter->tags()->sync($validated['tags']);

            return redirect()->to('admin');
        })->name('matter.update');

        Route::delete('/matter/{matter}', function (Request $request, Matter $matter) {
            $matter->delete();

            return redirect()->to('admin');
        })->name('matter.destroy');
    });

