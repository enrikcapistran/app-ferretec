<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Admin\ReservationController;

use App\Http\Controllers\Admin\KitController;
use App\Http\Controllers\Admin\ProductoController;
use App\Http\Controllers\Admin\TiendaController;
use App\Http\Controllers\Admin\VentaController;

use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\MenuController as FrontendMenuController;


use App\Http\Controllers\Frontend\KitController as FrontendKitController;
use App\Http\Controllers\Frontend\ProductoController as FrontendProductoController;


use App\Http\Controllers\Frontend\ReservationController as FrontendReservationController;
use App\Http\Controllers\Frontend\WelcomeController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Reservation;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [WelcomeController::class, 'index']);
//Route::get('/categories', [FrontendCategoryController::class, 'index'])->name('categories.index');
//Route::get('/categories/{category}', [FrontendCategoryController::class, 'show'])->name('categories.show');
//Route::get('/menus', [FrontendMenuController::class, 'index'])->name('menus.index');


Route::get('/kits', [FrontendKitController::class, 'index'])->name('kits.index');
Route::get('/kits/{kit}', [FrontendKitController::class, 'show'])->name('kits.show');
Route::get('/productos', [FrontendProductoController::class, 'index'])->name('productos.index');
Route::get('/productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');

Route::get('/reservation/step-one', [FrontendReservationController::class, 'stepOne'])->name('reservations.step.one');
Route::post('/reservation/step-one', [FrontendReservationController::class, 'storeStepOne'])->name('reservations.store.step.one');
Route::get('/reservation/step-two', [FrontendReservationController::class, 'stepTwo'])->name('reservations.step.two');
Route::post('/reservation/step-two', [FrontendReservationController::class, 'storeStepTwo'])->name('reservations.store.step.two');
Route::get('/gracias', [WelcomeController::class, 'gracias'])->name('gracias');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/kits', KitController::class);
    Route::resource('/productos', ProductoController::class);
    Route::resource('/tiendas', TiendaController::class);
    Route::resource('/ventas', VentaController::class);
});

require __DIR__ . '/auth.php';
