<?php

namespace App\Providers;

use App\Models\Language;
use App\Models\Menu;
use App\Models\menuitem;
use App\Models\site_settings;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer('themes/food/top_footer/top_menu', function ($view) {
            $main_language = Language::where('main_language',1)->first();
            $data['site_setting'] = site_settings::where('language_id',$main_language->id)->first();
            $data['menu_top'] = Menu::where('language_id',$main_language->id)->first();
            $data['menu_item_model'] = new menuitem();
            $view->with($data);
        });
    }
}
