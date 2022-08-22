<?php
use App\Http\Controllers\authentication\AuthenticationController;

Route::get('/sign-in',[AuthenticationController::class, 'sign_in'])->name('sign_in')->middleware('guest');
Route::post('/sign-in-post',[AuthenticationController::class, 'sign_in_post'])->name('sign_in_post')->middleware('guest');



Route::middleware(['auth'])->prefix('Kpanel')->group(function () { // bunun içerisine yazdığımız bütün linkler giriş linki isteyecektir.
    Route::get('/logout',[AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');

    Route::get('/', function () {
        return redirect(route('dashboard'));
    })->name('mentumpanel');

    Route::get('/dashboard', function () {
        return view("Kpanel.welcome");
    })->name('dashboard');
});
