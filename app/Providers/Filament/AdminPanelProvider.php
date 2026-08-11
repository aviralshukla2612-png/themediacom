<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
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
            ->path('portal')
            ->viteTheme('resources/css/filament/admin/theme.css')
            ->defaultThemeMode(\Filament\Enums\ThemeMode::Dark)
            ->darkMode(true, true) // Force dark mode, disable toggle
            ->login()
            ->colors([
                'primary' => '#E60026',
            ])
            ->font('Poppins')
            ->brandName('The Media Com')
            ->brandLogo(fn () => view('filament.logo'))
            ->brandLogoHeight('2rem')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                \App\Filament\Widgets\StatsOverview::class,
            ])
            ->navigationGroups([
                NavigationGroup::make('Website Content'),
                NavigationGroup::make('Leads'),
                NavigationGroup::make('Administration'),
                NavigationGroup::make('System')
                    ->collapsed(),
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

    public function boot(): void
    {
        \Filament\Support\Facades\FilamentView::registerRenderHook(
            \Filament\View\PanelsRenderHook::PAGE_START,
            fn (): string => \Illuminate\Support\Facades\Blade::render('
                <div class="mb-4">
                    <x-filament::button color="gray" tag="a" href="javascript:history.back()" icon="heroicon-m-arrow-left" size="sm" outlined>
                        Back
                    </x-filament::button>
                </div>
            ')
        );
        \Filament\Support\Facades\FilamentView::registerRenderHook(
            \Filament\View\PanelsRenderHook::HEAD_END,
            fn (): string => '<style>
                @media (max-width: 768px) {
                    .fi-ta-table thead { display: none !important; }
                    .fi-ta-table tbody tr {
                        display: flex !important;
                        flex-wrap: wrap !important;
                        align-items: center !important;
                        justify-content: space-between !important;
                        margin-bottom: 1rem;
                        background: rgba(255, 255, 255, 0.03);
                        border: 1px solid rgba(255, 255, 255, 0.1);
                        border-radius: 0.75rem;
                        padding: 1rem;
                        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                    }
                    .fi-ta-table tbody td {
                        display: block !important;
                        padding: 0.5rem !important;
                        border: none !important;
                    }
                    /* Action buttons full width at bottom */
                    .fi-ta-table tbody td:last-child {
                        width: 100%;
                        display: flex !important;
                        justify-content: flex-end !important;
                        border-top: 1px solid rgba(255, 255, 255, 0.05) !important;
                        margin-top: 0.5rem;
                        padding-top: 0.75rem !important;
                    }
                }
            </style>'
        );
    }
}
