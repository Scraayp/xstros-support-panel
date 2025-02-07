<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\MainController::class, 'view'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/user/list', [\App\Http\Controllers\UserController::class, 'view'])->middleware(['auth', 'verified'])->name('user.list');
    Route::get('/user/{user}', [\App\Http\Controllers\UserController::class, 'edit'])->name('user.edit');

    Route::patch('/user/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('user.update');

    Route::delete('/user/{user}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('user.destroy');
});


Route::middleware('auth', 'verified')->group(function () {
    Route::get('/ticket/new', [\App\Http\Controllers\TicketController::class, 'new'])->name('ticket.new');
    Route::post('/ticket/new', [\App\Http\Controllers\TicketController::class, 'create'])->name('ticket.create');

    Route::get('/ticket/{ticket}', [\App\Http\Controllers\TicketController::class, 'view'])->name('ticket.view');
    Route::post('/ticket/{ticket}/reply', [\App\Http\Controllers\TicketController::class, 'reply'])->name('ticket.replies.store');

    Route::delete('/ticket/{ticket}', [\App\Http\Controllers\TicketController::class, 'close'])->name('ticket.close');
});

Route::get('/429', function () {
    return view('error.toomanyrequests');
});

require __DIR__.'/auth.php';
