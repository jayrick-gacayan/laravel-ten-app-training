<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:user'])->name('dashboard');

Route::middleware('auth')
    ->controller(ProfileController::class)
    ->name('profile.')
    ->group(
        function () {
            Route::get('/profile', 'edit')->name('edit');
            Route::patch('/profile','update')->name('update');
            Route::delete('/profile','destroy')->name('destroy');
        }
    );

require __DIR__.'/auth.php';

Route::controller(AdminController::class)
    ->middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')->group(
    function(){
        Route::get('/dashboard', 'dashboard')->name('dashboard');
        Route::get('/logout', 'logout')->name('logout');
    }
);


Route::middleware('guest')->group(
    function(){
        Route::get('/admin/login', 'AdminController@login');
    }
);

Route::controller(AgentController::class)
    ->prefix('agent')
    ->name('agent.')->group(
    function(){
        Route::get('/dashboard', 'AgentDashboard')->middleware(['auth', 'role:agent']);
    }
);