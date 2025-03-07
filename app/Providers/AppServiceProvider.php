<?php

namespace App\Providers;

use App\Http\Responses\LogoutResponse;
use BezhanSalleh\PanelSwitch\PanelSwitch;
use Filament\Http\Responses\Auth\Contracts\LogoutResponse as LogoutResponseContract;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LogoutResponseContract::class, LogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        PanelSwitch::configureUsing(function (PanelSwitch $panelSwitch) {
            $panelSwitch
                ->modalWidth('sm')
                ->visible(fn(): bool => auth()->user()->isAdmin())
                ->slideOver();
        });
    }
}
