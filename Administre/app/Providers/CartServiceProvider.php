<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Cart;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer('layouts.app', function ($view) {
            $user = auth()->user();
            $cartItemCount = 0;
            if ($user && $user->cart) {
                $cartItemCount = $user->cart->items->count();
            }
            $view->with('cartItemCount', $cartItemCount);
        });
    }
}
