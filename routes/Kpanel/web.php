<?php
use App\Http\Controllers\authentication\AuthenticationController;

Route::get('/sign-in',[AuthenticationController::class, 'sign_in'])->name('sign_in')->middleware('guest');
Route::post('/sign-in-post',[AuthenticationController::class, 'sign_in_post'])->name('sign_in_post')->middleware('guest');


Route::get('/sign-up',[AuthenticationController::class, 'sign_up'])->name('sign_up')->middleware('guest');
Route::post('/sign-up-post',[AuthenticationController::class, 'sign_up_post'])->name('sign_up_post')->middleware('guest');

Route::middleware(['auth'])->prefix('Kpanel')->group(function () { // bunun içerisine yazdığımız bütün linkler giriş linki isteyecektir.
    Route::get('/logout',[AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');

    Route::get('/', function () {
        return redirect(route('dashboard'));
    })->name('mentumpanel');

    Route::get('/dashboard', function () {
        dd("asd");
    })->name('dashboard');
});
