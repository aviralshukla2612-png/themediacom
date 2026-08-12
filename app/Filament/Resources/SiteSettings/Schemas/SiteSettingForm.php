<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Set;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ── Site Identity ──────────────────────────────────────────
                \Filament\Schemas\Components\Section::make('Site Identity')
                    ->description('The logo and favicon currently live on your website.')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Site Name')
                            ->placeholder('e.g. The Media Com')
                            ->helperText('Fallback text used when the logo cannot be loaded.')
                            ->required(),
                        FileUpload::make('logo_image')
                            ->label('Site Logo (Active)')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->nullable(),
                        FileUpload::make('favicon_image')
                            ->label('Site Favicon')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->imagePreviewHeight('100')
                            ->helperText('Shown on browser tabs. Recommended: 32x32px or 64x64px square image.')
                            ->nullable(),
                    ]),

                // ── Scheduled Logo Change ──────────────────────────────────
                \Filament\Schemas\Components\Section::make('⏰ Scheduled Logo Change')
                    ->description('Upload a new logo and set the exact date & time to go live. The system will swap it automatically — no manual action needed.')
                    ->icon('heroicon-o-clock')
                    ->schema([

                        // Status info card
                        \Filament\Forms\Components\Placeholder::make('schedule_status')
                            ->label('Current Pending Schedule')
                            ->content(function ($record) {
                                if (! $record || ! $record->scheduled_logo_at) {
                                    return new \Illuminate\Support\HtmlString(
                                        '<span style="color:#6b7280;font-size:0.875rem;">No logo change scheduled.</span>'
                                    );
                                }
                                $time = \Illuminate\Support\Carbon::parse($record->scheduled_logo_at)
                                    ->timezone('Asia/Kolkata')
                                    ->format('D, d M Y • h:i A');
                                return new \Illuminate\Support\HtmlString(
                                    '<div style="display:flex;align-items:center;gap:10px;background:#fef3c7;border:1px solid #f59e0b;border-radius:8px;padding:12px 16px;">'
                                    . '<span style="font-size:1.4rem;">🕐</span>'
                                    . '<div>'
                                    . '<div style="color:#92400e;font-weight:600;font-size:0.8rem;text-transform:uppercase;letter-spacing:0.05em;">Logo going live at</div>'
                                    . '<div style="color:#b45309;font-size:1rem;font-weight:700;">' . $time . ' IST</div>'
                                    . '</div>'
                                    . '</div>'
                                );
                            })
                            ->columnSpanFull(),

                        FileUpload::make('scheduled_logo')
                            ->label('New Logo (will go live at the scheduled time)')
                            ->image()
                            ->disk('public')
                            ->directory('site')
                            ->helperText('Upload the logo you want to go live at the scheduled time below.')
                            ->nullable()
                            ->columnSpanFull(),

                        DateTimePicker::make('scheduled_logo_at')
                            ->label('Go-Live Date & Time (IST)')
                            ->timezone('Asia/Kolkata')
                            ->native(false)                 // Filament's custom calendar grid
                            ->minDate(now('Asia/Kolkata'))  // Block past dates
                            ->default(                       // Pre-fill: tomorrow at 9:00 AM
                                now('Asia/Kolkata')->addDay()->setTime(9, 0, 0)
                            )
                            ->displayFormat('d M Y, h:i A') // e.g. 13 Aug 2026, 09:00 AM
                            ->hoursStep(1)
                            ->minutesStep(15)               // Clean steps: :00, :15, :30, :45
                            ->seconds(false)
                            ->helperText('Pick any future date & time. Logo will swap automatically within 1 minute.')
                            ->nullable(),

                        // Cancel Schedule button — only shown when a schedule exists
                        \Filament\Schemas\Components\Actions::make([
                            Action::make('cancel_schedule')
                                ->label('🗑  Cancel Scheduled Change')
                                ->color('danger')
                                ->outlined()
                                ->requiresConfirmation()
                                ->modalHeading('Cancel the scheduled logo change?')
                                ->modalDescription('This will remove the pending schedule. The current active logo stays unchanged.')
                                ->modalSubmitActionLabel('Yes, cancel it')
                                ->visible(fn ($record) => $record && $record->scheduled_logo_at)
                                ->action(function (Set $set, $record) {
                                    if ($record) {
                                        \Illuminate\Support\Facades\DB::table('site_settings')
                                            ->where('id', $record->id)
                                            ->update([
                                                'scheduled_logo'    => null,
                                                'scheduled_logo_at' => null,
                                            ]);
                                        \Illuminate\Support\Facades\Cache::forget('global_seo_settings');
                                        \Illuminate\Support\Facades\Cache::forget('logo_schedule_last_check');
                                    }
                                    $set('scheduled_logo', null);
                                    $set('scheduled_logo_at', null);
                                }),
                        ])->columnSpanFull(),

                    ]),
            ]);
    }
}
