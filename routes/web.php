<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupFareController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\FlightBookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\BookingManageController;
use App\Http\Controllers\admin\AirlineController;
use App\Http\Controllers\admin\RoutesController;
use App\Http\Controllers\admin\PaymentTransactionsController;
use App\Http\Controllers\admin\ProfileController;








Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/access', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected route
// Route::middleware('auth')->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::get('/admin/booking/list', [BookingManageController::class, 'bookingList'])
    ->name('admin.booking.list')
    ->middleware('auth');

Route::get('admin/booking/pnr/{id}', [BookingManageController::class, 'Pnr'])
    ->name('admin.booking.Pnr');

Route::post('admin/booking/update-pnr', [BookingManageController::class, 'updatePnr'])
    ->name('admin.booking.updatePnr');


Route::post('/admin/booking/cancel', [BookingManageController::class, 'cancelTicket'])->name('admin.booking.cancel');




Route::get('/admin/airline/list', [AirlineController::class, 'index'])
    ->name('admin.airline.list')
    ->middleware('auth');
Route::post('/admin/airline/update-code', [AirlineController::class, 'updateCode'])->name('admin.airline.updateCode');

Route::get('/admin/group', [RoutesController::class, 'index'])
    ->name('admin.group')
    ->middleware('auth');

Route::get('/admin/gfares/list/{id}', [BookingManageController::class, 'flightlist'])
    ->name('admin.gfares.list')
    ->middleware('auth');

Route::get('/admin/gfares/create/{id}', [BookingManageController::class, 'create'])
    ->name('admin.gfares.create')
    ->middleware('auth');

Route::get('/admin/gfares/edit/{id}', [BookingManageController::class, 'edit'])
    ->name('admin.gfares.edit')
    ->middleware('auth');

Route::post('/admin/gfares/update', [BookingManageController::class, 'update'])
    ->name('admin.gfares.update')
    ->middleware('auth');

Route::get('/airports/search', [RoutesController::class, 'autoairport'])->name('airports.search');
Route::get('/admin/airlines/search', [RoutesController::class, 'airlinessearch'])->name('airlines.search');

Route::post('/admin/gfares/storeOrUpdate', [BookingManageController::class, 'storeOrUpdate'])
    ->name('admin.gfares.storeOrUpdate')
    ->middleware('auth');

Route::post('/admin/route/storeOrUpdate', [RoutesController::class, 'storeOrUpdate'])
    ->name('admin.route.storeOrUpdate')
    ->middleware('auth');

Route::get('/admin/route/create', [RoutesController::class, 'create'])
    ->name('admin.route.create')
    ->middleware('auth');

Route::post('/admin/route/edit/{id}', [RoutesController::class, 'edit'])
    ->name('admin.route.edit')
    ->middleware('auth');

Route::get('/admin', [DashboardController::class, 'index'])
    ->name('admin')
    ->middleware('auth');
// ---------------------------------user management------------------------
Route::post('/payment/balance', [PaymentTransactionsController::class, 'index'])
    ->name('payment.balance')
    ->middleware('auth');


// -------------------------Payment routes---------------------------------


Route::get('/admin/profile/view', [ProfileController::class, 'index'])
    ->name('admin.profile.view')
    ->middleware('auth');


Route::get('/admin/users/{id}/edit', [ProfileController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{id}', [ProfileController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{id}', [ProfileController::class, 'destroy'])->name('admin.users.destroy');
Route::get('/admin/users/balance/{id}', [ProfileController::class, 'balance'])->name('admin.users.balance');
// ------------------------payment routes--------------------------------------
Route::post('transactions/add-balance', [ProfileController::class, 'addBalance'])->name('admin.transactions.addBalance');
Route::post('/wallet/pay-now', [ProfileController::class, 'payNow'])->name('wallet.payNow');

// Route::post('/users/add-balance', [App\Http\Controllers\Admin\UserController::class, 'addBalance'])
//     ->name('admin.users.addBalance');
Route::fallback(function () {
    return response()->view('errors_404', [], 404);
})->name('404');

// ---------------------------------Ticket Management-------------------------

// Cancel ticket
// Route::post('/admin/bookings/{booking}/cancel', [BookingManageController::class, 'cancelTicket'])->name('admin.booking.cancel');

// Refund ticket
Route::get('/admin/bookings/refund/{id}', [BookingManageController::class, 'refundTicket'])->name('admin.booking.refund');
Route::get('/bookings/list', [BookingManageController::class, 'bookingList'])->name('bookings.list');
// ----------------------------itiniry routes---------------------------------

Route::resource('/', RouteController::class);

Route::get('routes/view/{id}', [RouteController::class, 'routes_view'])->name('routes.view');
Route::post('/book-flight', [FlightBookingController::class, 'booking'])->name('book.flight');
Route::post('/booking/confirmed', [FlightBookingController::class, 'store'])->name('booking.confirmed');
Route::get('/flights/tickets/{id}', [FlightBookingController::class, 'tickets'])
    ->name('flights.tickets');

