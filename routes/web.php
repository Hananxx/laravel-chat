<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\InvitationController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    return Inertia::render('Chat', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return Inertia::render('Dashboard');
//})->name('dashboard');

//Route::middleware(['auth:sanctum', 'verified'])->get('/chat', function () {
//    return Inertia::render('Chat');
//})->name('chat');

Route::middleware(['auth:sanctum'])->prefix('chat')->group(function () {
    Route::get('rooms', [ChatController::class, 'rooms']);
    Route::get('room/{roomId}/messages', [ChatController::class, 'messages']);
    Route::post('room/{roomId}/message', [ChatController::class, 'newMessage']);

    Route::post('/new-room', [ChatController::class, 'startNewChatRoom']);
});

Route::middleware(['auth:sanctum'])->prefix('invitation')->group(function () {
    Route::get('/', [InvitationController::class, 'getPendingInvitaions']);
    Route::post('/create', [InvitationController::class, 'createInvitation']);
    Route::post('/accept', [InvitationController::class, 'acceptInvitation']);

});

Route::middleware(['auth'])->get('/user', [\App\Http\Controllers\UserController::class, 'search']);
