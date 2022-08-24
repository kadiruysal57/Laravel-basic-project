<?php
use App\Http\Controllers\authentication\AuthenticationController;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\contents\ContentsController;
use Illuminate\Http\Request;

Route::get('/sign-in',[AuthenticationController::class, 'sign_in'])->name('sign_in')->middleware('guest');
Route::post('/sign-in-post',[AuthenticationController::class, 'sign_in_post'])->name('sign_in_post')->middleware('guest');



Route::middleware(['auth'])->prefix('Kpanel')->group(function () { // bunun içerisine yazdığımız bütün linkler giriş linki isteyecektir.
    Route::get('/logout',[AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');

    Route::get('/', function () {
        return redirect(route('dashboard'));
    })->name('kpanel');

    Route::get('/dashboard', function () {
        return view("Kpanel.welcome");
    })->name('dashboard');

    Route::post('/name_convert_slug', function (Request $request) {
        return response()->json(['type'=>'success','slug' => \Illuminate\Support\Str::slug($request->value)]);
    })->name('name_convert_slug');

    Route::resource('language', LanguageController::class);
    Route::resource('contents', ContentsController::class);


});
