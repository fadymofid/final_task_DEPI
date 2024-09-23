<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
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

Route::post('/register', [RegisterController::class, 'apiRegister']);

Route::middleware('auth:sanctum')->group(function () {





    Route::post('/login', [LoginController::class, 'apiLogin']);
    Route::post('/logout', [LoginController::class, 'apiLogout']);



    Route::get('/notifications', [NotificationController::class, 'apiIndex']);
    Route::post('/notifications', [NotificationController::class, 'apiStore']);
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'apiMarkAsRead']);
    Route::delete('/notifications/{notification}', [NotificationController::class, 'apiDestroy']);


    Route::post('/tickets', [TicketController::class, 'store']); // Create a new ticket
    Route::get('/tickets/{ticket}', [TicketController::class, 'show']); // Show a specific ticket
    Route::post('/tickets/{ticket}/comments', [TicketController::class, 'addComment']); // Add a comment to a ticket
    Route::get('/tickets', [TicketController::class, 'myTickets']);


    Route::get('/notifications', [NotificationController::class, 'index']); // Get user notifications
    Route::post('/notifications', [NotificationController::class, 'store']); // Send a new notification
    Route::post('/notifications/{notification}/read', [NotificationController::class, 'markAsRead']); // Mark notification as read
    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy']); // Delete a notification









});

