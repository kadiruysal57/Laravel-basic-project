<?php
use App\Http\Controllers\authentication\AuthenticationController;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\contents\ContentsController;
use Illuminate\Http\Request;
use App\Http\Controllers\menu\MenuController;
use App\Http\Controllers\slider\SliderController;
use App\Http\Controllers\SiteSettings\SiteSettingsController;
use App\Http\Controllers\socialmedia\SocialMediaController;
use App\Http\Controllers\formbuilder\FormBuilderController;


Route::get('/sign-in',[AuthenticationController::class, 'sign_in'])->name('sign_in')->middleware('guest');
Route::post('/sign-in-post',[AuthenticationController::class, 'sign_in_post'])->name('sign_in_post')->middleware('guest');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


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

    Route::group(['prefix' => '/laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();

    });
    Route::POST('/formbuilder/input_type_list',[FormBuilderController::class, 'input_type_list'])->name('formbuilder.input_type_list');
    Route::POST('/formbuilder/selectboxloop',[FormBuilderController::class, 'selectboxloop'])->name('formbuilder.selectboxloop');


    Route::resource('language', LanguageController::class);
    Route::resource('contents', ContentsController::class);
    Route::resource('menu', MenuController::class);
    Route::resource('slider', SliderController::class);
    Route::resource('site-settings', SiteSettingsController::class);
    Route::resource('social-media', SocialMediaController::class);
    Route::resource('form-builder', FormBuilderController::class);





});
