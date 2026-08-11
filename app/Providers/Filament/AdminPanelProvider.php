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
                    /* Change stacked cell to flex-row (Label Left, Content Right) */
                    /* Change stacked cell to flex-row (Label Left, Content Right) */
                    .fi-ta-table .fi-ta-cell:not(.hidden) {
                        display: flex !important;
                        flex-direction: row !important;
                        justify-content: space-between !important;
                        align-items: center !important;
                        width: 100% !important;
                        gap: 1rem !important;
                        border-bottom: 1px solid rgba(255,255,255,0.05);
                        padding: 0.75rem 0 !important;
                    }
                    .fi-ta-table .fi-ta-cell.hidden {
                        display: none !important;
                    }
                    .fi-ta-table .fi-ta-cell:last-child {
                        border-bottom: none !important;
                    }
                    .fi-ta-table .fi-ta-cell-label {
                        font-weight: 600 !important;
                        opacity: 0.9;
                        flex-shrink: 0;
                    }
                    .fi-ta-table .fi-ta-cell-content {
                        flex-grow: 1;
                        display: flex;
                        justify-content: flex-end;
                        align-items: center;
                    }
                    .fi-ta-table .fi-ta-cell-content > * {
                        text-align: right !important;
                        display: flex;
                        justify-content: flex-end;
                        width: auto !important;
                    }
                    .fi-ta-table .fi-ta-cell-content img, .fi-ta-table .fi-ta-cell-content video {
                        margin-left: auto;
                    }
                    /* Action buttons right aligned */
                    .fi-ta-table td:last-child > div,
                    .fi-ta-table .fi-ta-actions {
                        display: flex !important;
                        justify-content: flex-end !important;
                        width: 100% !important;
                        padding-top: 0.5rem !important;
                        border-top: 1px solid rgba(255,255,255,0.05);
                    }
                    /* Styling the whole card container */
                    .fi-ta-table tbody tr {
                        background: rgba(255, 255, 255, 0.03) !important;
                        border: 1px solid rgba(255, 255, 255, 0.1) !important;
                        border-radius: 0.75rem !important;
                        padding: 1.25rem !important;
                        margin-bottom: 1.5rem !important;
                        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
                    }
                }
            </style>'
        );
    }
}
