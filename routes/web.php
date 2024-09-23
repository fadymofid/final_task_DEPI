<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;

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
    return redirect()->route('login'); // Redirect to the login page
});

// Show registration form
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

// Handle registration
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Notifications Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/read/{notification}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::delete('notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');

    // Admin notification routes
    Route::get('/notifications/create/{userId}', [NotificationController::class, 'create'])->name('notifications.create');
    Route::post('/notifications', [NotificationController::class, 'store'])->name('notifications.store');
    // Admin user routes
//    Route::get('/admin/users', [AdminController::class, 'index']);

    // Ticket routes
// Ticket routes
    Route::get('/tickets', [TicketController::class, 'myTickets'])->name('all_tickets'); // For viewing all user tickets
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create'); // For creating a new ticket
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store'); // For storing a new ticket
    Route::post('/tickets/{ticket}/comments', [TicketController::class, 'addComment'])->name('tickets.comments'); // For adding comments
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show'); // For showing a specific ticket


    Route::get('/users', [UserController::class, 'index'])->name('users.index'); // Adjust as necessary
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/users/export-pdf', [UserController::class, 'exportPdf'])->name('users.exportPdf');

});
