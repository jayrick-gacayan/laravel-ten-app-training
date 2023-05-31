<?php

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::controller(Auth\RegisteredUserController::class)
        ->prefix('register')
        ->group(
            function(){
                Route::get('/', 'create')->name('register');
                Route::post('/', 'store');
            }
        );
    
    Route::controller(Auth\AuthenticatedSessionController::class)
        ->prefix('login')
        ->group(
            function(){
                Route::get('/', 'create')->name('login');
                Route::post('/', 'store');
            }
        );
    
    Route::controller(Auth\PasswordResetLinkController::class)
        ->prefix('forgot-password')
        ->name('password.')
        ->group(
            function(){
                Route::get('/', 'create')->name('request');
                Route::post('/', 'store')->name('email');
            }
        );
    
    Route::controller(Auth\NewPasswordController::class)
        ->prefix('reset-password')
        ->name('password.')
        ->group(
            function(){
                Route::get('/{token}', 'create')->name('reset');
                Route::post('/', 'store')->name('store');
            }
        );
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', Auth\EmailVerificationPromptController::class)
                ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', Auth\VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    Route::post('email/verification-notification', 'Auth\EmailVerificationNotificationController@store')
                ->middleware('throttle:6,1')
                ->name('verification.send');

    Route::controller(Auth\ConfirmablePasswordController::class)
        ->prefix('confirm-password')
        ->group(
            function(){
                Route::get('/', 'show')->name('password.confirm');
                Route::post('/', 'store');
            }
        );
    
    Route::put('password', 'Auth\PasswordController@update')->name('password.update');
    Route::post('logout', 'Auth\AuthenticatedSessionController@destroy')->name('logout');
});
