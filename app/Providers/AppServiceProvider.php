<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ** Global User Data **
        View::composer('*', function($view){
            if(Auth::check()){
                $user_id = Auth::user()->id;
                $user_data = User::find($user_id);
                $view->with('user_data', $user_data);
            }
        });
    }
}
