<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect()->route('ticket.list');
})->name('dashboard')->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/user/new', [\App\Http\Controllers\UserController::class, 'new'])->name('user.new');
    Route::post('/user/create', [\App\Http\Controllers\UserController::class, 'create'])->middleware(['throttle:2,3'])->name('user.create');
    Route::get('/user/list', [\App\Http\Controllers\UserController::class, 'view'])->middleware(['auth', 'verified'])->name('user.list');
    Route::get('/user/{user}', [\App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');

    Route::patch('/user/{user}', [\App\Http\Controllers\UserController::class, 'update'])->middleware(['throttle:2,5'])->name('user.update');

    Route::delete('/user/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->middleware(['throttle:2,3'])->name('user.destroy');
});


Route::middleware('auth', 'verified')->group(function () {
    Route::get('/ticket/list', [\App\Http\Controllers\TicketController::class, 'list'])->name('ticket.list');

    Route::get('/ticket/new', [\App\Http\Controllers\TicketController::class, 'new'])->name('ticket.new');
    Route::post('/ticket/new', [\App\Http\Controllers\TicketController::class, 'create'])->middleware(['throttle:2,3'])->name('ticket.create');

    Route::get('/ticket/{ticket}', [\App\Http\Controllers\TicketController::class, 'view'])->name('ticket.view');
    Route::post('/ticket/{ticket}/reply', [\App\Http\Controllers\TicketController::class, 'reply'])->middleware(['throttle:5,3'])->name('ticket.replies.store');

    Route::post('tickets/{ticket}/assign', [\App\Http\Controllers\TicketController::class, 'assignStaff'])->name('ticket.assign');

    Route::delete('/ticket/{ticket}', [\App\Http\Controllers\TicketController::class, 'close'])->middleware(['throttle:5,3'])->name('ticket.close');
});

Route::post('/notifications/mark-as-read', function () {
    Auth::user()->unreadNotifications->markAsRead();
    return back();
})->name('notifications.markAsRead');

Route::delete('/notifications/{id}', function ($id) {

    if (!Auth::user()->notifications()->find($id)) {
        abort(403, 'Unauthorized action.');
    }
    Auth::user()->notifications()->find($id)?->delete();
    return back();
})->name('notifications.delete');


Route::get('/429', function () {
    return view('error.toomanyrequests');
});

require __DIR__.'/auth.php';
require __DIR__.'/stripe.php';
require __DIR__.'/payments.php';
