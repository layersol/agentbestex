<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GroupFareController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\FlightBookingController;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\BookingManageController;
use App\Http\Controllers\admin\AirlineController;
use App\Http\Controllers\admin\RoutesController;
use App\Http\Controllers\admin\PaymentTransactionsController;
use App\Http\Controllers\admin\ProfileController;

// Backend Controllers
use App\Http\Controllers\backend\apimodule\ApiModuleController;
use App\Http\Controllers\backend\fronted\frontendController;
use App\Http\Controllers\backend\booking\bookingcontroller;
use App\Http\Controllers\backend\dashboard\DashboardController;
use App\Http\Controllers\backend\general\generalcontroller;
use App\Http\Controllers\backend\packages\PackagesController;
use App\Http\Controllers\backend\payments\PaymentsController;
use App\Http\Controllers\backend\roles_permissions\RolesPermissionsController;
use App\Http\Controllers\backend\settings\SettingsController;
use App\Http\Controllers\backend\support\SupportController;
use App\Http\Controllers\backend\users\UsersController;

// Frontend Controllers

use App\Http\Controllers\frontend\Home\HomeController;
use App\Http\Controllers\frontend\Payments\PaymentsController as FrontendPaymentsController;
use App\Http\Controllers\frontend\Search\SearchController;
use App\Http\Controllers\frontend\searchcopy\SearchCopyController;
use App\Http\Controllers\frontend\Toures\TouresController;






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





Route::middleware(['auth'])->group(function () {

    // Dashboard
     Route::prefix('backend')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('dashboard/create', [DashboardController::class, 'create'])
            ->name('dashboard.create');

             Route::get('dashboard/edit', [DashboardController::class, 'edit'])
            ->name('dashboard.edit');
            Route::get('dashboard/list', [DashboardController::class, 'list'])
            ->name('dashboard.list');

});

    // APIModule CRUD
    Route::prefix('backend')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('apiModules/create', [ApiModuleController::class, 'create'])
            ->name('apiModules.create');

             Route::get('apiModules/edit', [ApiModuleController::class, 'edit'])
            ->name('apiModules.edit');
            Route::get('apiModules/list', [ApiModuleController::class, 'list'])
            ->name('apiModules.list');

        // Route::get('/account', [AccountController::class, 'show'])
        //     ->name('backend.account.show');

        // // ⭐ Correct API Module routes
        // Route::prefix('api-module')->name('backend.api-module.')->group(function () {
        //     Route::resource('/', ApiModuleController::class)->parameters([
        //         '' => 'apiModule'
        //     ]);
        // });

});

    // Auth module CRUD
    Route::prefix('auth')->group(function () {
        Route::resource('/', AuthController::class);
    });

    // Booking module CRUD
     Route::prefix('backend')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('booking/create', [ApiModuleController::class, 'create'])
            ->name('booking.create');

             Route::get('booking/edit', [ApiModuleController::class, 'edit'])
            ->name('booking.edit');
            Route::get('booking/list', [ApiModuleController::class, 'list'])
            ->name('booking.list');

    

});

// frontend module CRUD
    //  Route::prefix('backend')
    // ->middleware(['auth'])
    // ->group(function () {

    //     Route::get('/frontend/create', [FrontendController::class, 'create'])
    //         ->name('frontend.create');

    //          Route::get('/frontend/edit', [FrontendController::class, 'edit'])
    //         ->name('frontend.edit');

    //         Route::get('/frontend/list', [frontendController::class, 'list'])
    //         ->name('frontend.list');

// });

    // General module CRUD
     

    // Packages module CRUD
    Route::prefix('backend')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('packages/create', [PackagesController::class, 'create'])
            ->name('packages.create');

             Route::get('packages/edit', [PackagesController::class, 'edit'])
            ->name('packages.edit');
            Route::get('packages/list', [PackagesController::class, 'list'])
            ->name('packages.list');
    });
    });

    // Payments module CRUD (backend)
    Route::prefix('backend')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('payments/create', [PaymentsController::class, 'create'])
            ->name('payments.create');

             Route::get('payments/edit', [PaymentsController::class, 'edit'])
            ->name('payments.edit');
            Route::get('payments/list', [PaymentsController::class, 'list'])
            ->name('payments.list');
    });
    

    // Roles & Permissions module CRUD
    Route::prefix('roles_permissions')->group(function () {
        Route::resource('/', RolesPermissionsController::class);
    });

    // Settings module CRUD
     Route::prefix('backend')
    ->middleware(['auth'])
    ->group(function () {

        Route::get('settings/create', [SettingsController::class, 'create'])
            ->name('settings.create');

             Route::get('settings/edit', [SettingsController::class, 'edit'])
            ->name('settings.edit');
            Route::get('settings/list', [SettingsController::class, 'list'])
            ->name('settings.list');
    });

    // Support module CRUD
    Route::prefix('support')->group(function () {
        Route::resource('/', SupportController::class);
    });

    // Users module CRUD
    Route::prefix('users')->group(function () {
        Route::resource('/', UsersController::class);
    });

      // Frontend modules
     Route::prefix('frontend')->group(function () {
        Route::resource('flight-booking', FlightBookingController::class);
        Route::resource('home', HomeController::class);
        Route::resource('payments', FrontendPaymentsController::class);
        Route::resource('search', SearchController::class);
        Route::resource('search-copy', SearchCopyController::class);
        Route::resource('toures', TouresController::class);
    });

