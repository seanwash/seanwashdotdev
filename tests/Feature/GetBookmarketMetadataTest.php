<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use function Pest\Laravel\actingAs;

beforeEach(fn() => actingAs(User::factory()->create()));

test('a url parameter is required', function () {
    test()
        ->get(route('admin.matter.metadata'))
        ->assertSessionHasErrors('url');
});

// TODO: Rename.
test('metadata is returned', function (string $response, ?string $title, ?string $description) {
    Http::fake(['*' => HTTP::response($response)]);

    $response = test()->getJson(route('admin.matter.metadata', ['url' => 'https://alpinejs.dev/magics/watch']));

    ray($response);

    HTTP::assertSentCount(1);

    // TODO: Fix this. Is there a fluent API that we can use?
    if ($title) {
        expect($response->json()['title'])->toBe($title);
    }

    if ($description) {
        expect($response->json()['description'])->toBe($description);
    }
})->with([
    [
        <<<HTML
            <html lang="en">
                <head>
                     <title>test title</title>
                     <meta name="og:title" content="test title">
                     <meta name="og:image" content="">
                     <meta name="description" content="test description">
                </head>
            </html>
        HTML,
        'test title',
        'test description'
    ],
    [
        <<<HTML
            <html lang="en">
                <head>
                     <title>test title</title>
                </head>
                <body>
                    <section></section>
                </body>
            </html>
        HTML,
        'test title',
        null
    ],
    [
        <<<HTML
            <html lang="en">
                <head>
                     <meta name="description" content="test description">
                </head>
            </html>
        HTML,
        null,
        'test description'
    ]
]);
