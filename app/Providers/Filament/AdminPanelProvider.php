<?php
    
    namespace App\Providers\Filament;
    
    use CharrafiMed\GlobalSearchModal\GlobalSearchModalPlugin;
    use Filament\Http\Middleware\Authenticate;
    use Filament\Http\Middleware\AuthenticateSession;
    use Filament\Http\Middleware\DisableBladeIconComponents;
    use Filament\Http\Middleware\DispatchServingFilamentEvent;
    use Filament\Pages;
    use Filament\Panel;
    use Filament\PanelProvider;
    use Filament\Support\Colors\Color;
    use Filament\Support\Facades\FilamentView;
    use Filament\View\PanelsRenderHook;
    use Filament\Widgets;
    use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
    use Illuminate\Cookie\Middleware\EncryptCookies;
    use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
    use Illuminate\Routing\Middleware\SubstituteBindings;
    use Illuminate\Session\Middleware\StartSession;
    use Illuminate\Support\Facades\Blade;
    use Illuminate\View\Middleware\ShareErrorsFromSession;
    use Monzer\FilamentEmailVerificationAlert\EmailVerificationAlertPlugin;
    use RickDBCN\FilamentEmail\FilamentEmail;
    
    class AdminPanelProvider extends PanelProvider
    {
        public function panel(Panel $panel): Panel
        {
            FilamentView::registerRenderHook(
              PanelsRenderHook::TOPBAR_START,//USER_MENU_BEFORE,
              fn(
              ): string => ('<a  class="border font-semibold border rounded-lg px-3 py-2 text-sm" href=\' /\'>Home</a>'),
            );
            return $panel
              ->default()
              ->id('admin')
              ->path('admin')
              ->login()
              ->colors([
                'primary' => Color::Amber,
                'error' => Color::Red,
              ])
              ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
              ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
              ->pages([
                Pages\Dashboard::class,
              ])
              ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
              ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
              ])
              ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
              ])->renderHook(
                PanelsRenderHook::HEAD_START,
                fn(): string => Blade::render("@vite('resources/js/app.js')"),
              )
              ->plugins([
                FilamentEmail::make(),
              ])
              ->authMiddleware([
                Authenticate::class,
              ]);
        }
    }
