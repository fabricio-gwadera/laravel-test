<?php

use App\Http\Controllers\Web\GuestbookEntryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Route};

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

Route::controller(GuestbookEntryController::class)
    ->name('guestbook.')
    ->group(function () {
        Route::get('/','index')->name('index');

        Route::prefix('guestbook')
        ->group(function () {
            Route::get('/create','create')->name('create');
            Route::post('/create','store')->name('store');
        });
    });
