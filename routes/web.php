<?php


// user
use App\Http\Controllers\User\DashboardController as UserDashboard;
use App\Http\Controllers\User\CheckoutController as UserCheckout;
// admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\CheckoutController as AdminCheckout;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

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
    return view('welcome');
})->name('home');




Route::get('/signin-google', [UserController::class, 'google'])->name('user.login.google');
Route::get('/auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');

Route::middleware(['auth'])->group(function () {
    Route::get('checkout/success', [UserCheckout::class, 'success'])->name('checkout.success')->middleware('ensureUserRole:user');
    Route::post('checkout/{camp}', [UserCheckout::class, 'store'])->name('checkout.store')->middleware('ensureUserRole:user');
    Route::get('checkout/{camp:slug}', [UserCheckout::class, 'create'])->name('checkout.create')->middleware('ensureUserRole:user');


    // dashboard
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    // user dashboard
    Route::prefix('user/dashboard')->namespace('User')->name('user.')->group(function () {
        Route::get('/', [UserDashboard::class, 'index'])->name('dashboard')->middleware('ensureUserRole:user');
    });
    // admin dashboard
    Route::prefix('admin/dashboard')->namespace('Admin')->name('admin.')->group(function () {
        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard')->middleware('ensureUserRole:admin');

        // admin checkout
        Route::post('checkout/{checkout}', [AdminCheckout::class, 'update'])->name('checkout.update');
    });
});

require __DIR__ . '/auth.php';
