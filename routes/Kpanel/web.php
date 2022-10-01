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
use App\Http\Controllers\BlokManagement\BlokManagementController;
use App\Http\Controllers\Users\UsersController;
use App\Http\Controllers\permission\PermissionController;
use App\Models\roleslist;
use App\Models\permission;
use App\Models\userroles;
use App\Http\Controllers\gallery\GalleryController;
use App\Http\Controllers\SiteSettings\AddressController;
use App\Http\Controllers\SiteSettings\ThemesController;
use App\Http\Controllers\Whatsapp\WhatsappController;
use App\Http\Controllers\language\FixedLanguageWordController;
use App\Http\Controllers\staff\StaffController;
use App\Http\Controllers\Faq\FaqController;
use App\Http\Controllers\Portfolio\PortfolioController;
use App\Http\Controllers\Portfolio\PortfolioGroupController;



Route::get('/sign-in',[AuthenticationController::class, 'sign_in'])->name('sign_in')->middleware('guest');
Route::post('/sign-in-post',[AuthenticationController::class, 'sign_in_post'])->name('sign_in_post')->middleware('guest');

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


Route::middleware(['auth'])->prefix('Kpanel')->group(function () { // bunun içerisine yazdığımız bütün linkler giriş linki isteyecektir.


    Route::get('/insertTable', function () {

        if (Auth::id() == 1) {
            $disableRoute = array(
                'ignition.healthCheck',
                'ignition.executeSolution',
                'ignition.shareReport',
                'ignition.scripts',
                'ignition.styles',
                'ignition.updateConfig',
                'logout',
                'login',
                'unisharp.lfm',
                'unisharp.lfm.show',
                'unisharp.lfm.getErrors',
                'unisharp.lfm.upload',
                'unisharp.lfm.getItems',
                'unisharp.lfm.move',
                'unisharp.lfm.domove',
                'unisharp.lfm.getAddfolder',
                'unisharp.lfm.getFolders',
                'unisharp.lfm.getCrop',
                'unisharp.lfm.getCropimage',
                'unisharp.lfm.getCropnewimage',
                'unisharp.lfm.getRename',
                'unisharp.lfm.getResize',
                'unisharp.lfm.performResize',
                'unisharp.lfm.getDownload',
                'unisharp.lfm.getDelete',
                'unisharp.lfm.',
                'login_post',
                'formbuilder.input_type_list',
                'formbuilder.selectboxloop',
                'sanctum.csrf-cookie',
                'sign_in',
                'sign_in_post',
                'kpanel',
                'name_convert_slug',
                'language.create',
                'language.show',
                'language.edit',
                'language.update',
                'contents.edit',
                'contents.update',
                'menu.update',
                'slider.edit',
                'slider.update',
                'site-settings.create',
                'site-settings.show',
                'site-settings.edit',
                'site-settings.update',
                'site-settings.destroy',
                'social-media.index',
                'social-media.create',
                'social-media.show',
                'social-media.edit',
                'form-builder.update',
                'form-builder.edit',
                'blok-management.update',
                'blok-management.edit',
                'gallery.edit',
                'gallery.update',
                'permission.edit',
                'permission.update',
                'permission.destroy',
                'users.update',
                'users.edit',

            );
            $routeCollection = Route::getRoutes();
            foreach ($routeCollection as $route) {
                echo $route->getName()."<br>";
                if (!in_array(trim($route->getName()), $disableRoute) && !empty(trim($route->getName()))) {
                    $check = roleslist::where('roles_name', $route->getName())->get();
                    if (count($check) == 0) {
                        $result = roleslist::create([
                            'roles_name' => $route->getName(),
                            'status' => 1,
                            'add_user' => \Illuminate\Support\Facades\Auth::id(),
                        ]);
                        echo $route->getName() . "<br>";
                        $permission = permission::get();
                        foreach ($permission as $p) {
                            userroles::create([
                                'permission_id' => $p->id,
                                'roles_list_id' => $result->id,
                                'add_user' => Auth::id(),
                                'update_user' => 1,
                                'status' => 1,
                            ]);
                        }
                    }


                }

            }
        } else {
            die("Maalesef Yetkiniz Bulunmamaktadır Lütfen Geri Gidin");
        }
    })->middleware('auth');



    Route::get('/logout',[AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');

    Route::get('/', function () {
        return redirect(route('dashboard'));
    })->name('kpanel');

    Route::get('/dashboard', function () {
        return view("Kpanel.welcome");
    })->name('dashboard');

    Route::get('/error',function(){
        return view("Kpanel.401");
    });

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
    Route::resource('blok-management', BlokManagementController::class);
    Route::resource('users', UsersController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('gallery', GalleryController::class);
    Route::resource('address', AddressController::class);
    Route::resource('themes', ThemesController::class);
    Route::resource('whatsapp', WhatsappController::class);
    Route::resource('fixed-word', FixedLanguageWordController::class);
    Route::resource('staff', StaffController::class);
    Route::resource('faq', FaqController::class);
    Route::resource('portfolio', PortfolioController::class);
    Route::resource('portfolio-group',PortfolioGroupController::class);





});
