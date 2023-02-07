<?php

use App\Http\Controllers\API\GuestbookEntryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Routes for the guestbook API
 */

Route::controller(GuestbookEntryController::class)
    ->name('guestbook.')
    ->prefix('guestbook')
    ->group(function () {
        Route::get('/', 'index')
            ->name('index');

        Route::get('/my', 'my')
            ->name('my')
            ->middleware([
                \App\Http\Middleware\ProtectRoutesMiddleware::class,
            ]);

        Route::get('/{entry}', 'get')
            ->name('get');

        Route::delete('/{entry}', 'destroy')
            ->name('destroy');

        Route::middleware([
            \App\Http\Middleware\JsonContentType::class,
        ])
            ->group(function () {
                Route::post('/create', 'create')
                    ->name('create');

                Route::post('/update/{id}', 'update')
                    ->name('update')
                    ->middleware([
                        \App\Http\Middleware\ProtectRoutesMiddleware::class,
                    ]);
            });
    });
