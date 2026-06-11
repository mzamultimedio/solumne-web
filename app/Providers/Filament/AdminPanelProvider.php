<?php

namespace App\Providers\Filament;

use App\Filament\Pages\AiAssistantSettings;
use App\Filament\Pages\Dashboard as AdminDashboard;
use App\Filament\Widgets\AcademyStatsOverview;
use App\Filament\Widgets\PendingExamsWidget;
use App\Filament\Widgets\PendingInvoicesWidget;
use App\Filament\Widgets\QuickActions;
use App\Filament\Widgets\RecentCourses;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandLogo(asset('images/logo-solumne.png'))
            ->brandLogoHeight('48px')
            ->brandName(fn(): Htmlable|string => config('app.name', 'Solumne'))
            ->favicon(asset('favicon.ico'))
            ->colors([
                'primary' => Color::Amber,
            ])
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->sidebarCollapsibleOnDesktop(false)
            ->sidebarFullyCollapsibleOnDesktop(false)
            ->darkMode(true)
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                AdminDashboard::class,
                AiAssistantSettings::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                AcademyStatsOverview::class,
                QuickActions::class,
                PendingExamsWidget::class,
                PendingInvoicesWidget::class,
                RecentCourses::class,
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
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
