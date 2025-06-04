<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Partager les notifications avec la vue page.cv automatiquement
        View::composer('page.cv', function ($view) {
            $notifications = collect();
            $count = 0;

            if (Auth::check()) {
                $notifications = Notification::where('id_user', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

                $count = $notifications->where('estLu', false)->count();
            }

            $view->with([
                'notifications' => $notifications,
                'count' => $count
            ]);
        });
    }

    public function register()
    {
        //
    }
}
