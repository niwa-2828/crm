<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\InertiaController;
use App\Http\Controllers\MailSendController;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\ProjectsController;
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

Route::get('/inertia/index', [InertiaController::class, 'index'])->name('inertia.index');
Route::get('/inertia/create', [InertiaController::class, 'create'])->name('inertia.create');
Route::post('/inertia', [InertiaController::class, 'store'])->name('inertia.store');
Route::get('/inertia/show{id}', [InertiaController::class, 'show'])->name('inertia.show');
Route::delete('/inertia/{id}', [InertiaController::class, 'delete'])->name('inertia.delete');



Route::get('/inertia', function () {
  return Inertia::render('Inertia');
});

Route::get(
  '/component-test',
  function () {
    return Inertia::render('ComponentTest');
  }
);

// MailSend
Route::get('/mailsend/dashboard', [MailSendController::class, 'index'])->name('dashboard.index');
Route::get('/mailsend/send', [MailSendController::class, 'create'])->name('send.create');

// Companies
Route::prefix('companies')
  ->name('companies.')
  ->group(function () {
    Route::get('/index', [CompaniesController::class, 'index'])->name('index');
    Route::get('/create', [CompaniesController::class, 'create'])->name('create');
    Route::post('/store', [CompaniesController::class, 'store'])->name('store');
    // Route::get('/show{id}',[CompaniesController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [CompaniesController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [CompaniesController::class, 'update'])->name('update');
    Route::delete('/{id}', [CompaniesController::class, 'destroy'])->name('destroy');
  });



// Employees
Route::get('/employees/index', [EmployeesController::class, 'index'])->name('employees.index');
Route::get('/employees/create', [EmployeesController::class, 'create'])->name('employees.create');
Route::post('/employees/store', [EmployeesController::class, 'store'])->name('employees.store');
// Route::get('/employees/show{id}',[EmployeesController::class, 'show'])->name('employees.show');
Route::get('/employees/{id}/edit', [EmployeesController::class, 'edit'])->name('employees.edit');
Route::patch('/employees/{employee}', [EmployeesController::class, 'update'])->name('employees.update');
Route::delete('/employees/{employee}', [EmployeesController::class, 'destroy'])->name('employees.destroy');


// Projects
Route::prefix('projects')
  ->name('projects.')
  ->group(function () {
    Route::get('/index', [ProjectsController::class, 'index'])->name('index');
    Route::get('/create', [ProjectsController::class, 'create'])->name('create');
    Route::post('/store', [ProjectsController::class, 'store'])->name('store');
    // Route::get('/show{id}',[ProjectsController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ProjectsController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [ProjectsController::class, 'update'])->name('update');
    Route::delete('/{id}', [ProjectsController::class, 'destroy'])->name('destroy');
  });


Route::get('/', function () {
  return Inertia::render('Welcome', [
    'canLogin' => Route::has('login'),
    'canRegister' => Route::has('register'),
    'laravelVersion' => Application::VERSION,
    'phpVersion' => PHP_VERSION,
  ]);
});

Route::get('/dashboard', function () {
  return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
