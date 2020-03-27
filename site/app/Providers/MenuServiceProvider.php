<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Model\Menu;
use App\Model\Option;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        try{

            View::share('sysOptions', Option::initOption());
            View::share('menuTree', Menu::initTree());

        }catch(\Exception $e) {
            // 什么都不做 这边第一次初始化的时候可能 回报错 所以忽略掉
        }
    }
}
