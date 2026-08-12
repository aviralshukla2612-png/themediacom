<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ── Existing: Current Logo & Favicon ──────────────────────────
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

                // ── NEW: Scheduled Logo Change ─────────────────────────────────
                \Filament\Schemas\Components\Section::make('⏰ Scheduled Logo Change')
                    ->description('Upload a new logo and set the exact date & time to go live. The system will swap it automatically — no manual action needed.')
                    ->icon('heroicon-o-clock')
                    ->schema([

                        // Info card: shows current pending schedule (if any)
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
                                    ->format('d M Y, h:i A');
                                return new \Illuminate\Support\HtmlString(
                                    '<span style="color:#f59e0b;font-weight:600;">🕐 New logo scheduled to go live at: ' . $time . ' IST</span>'
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
                            ->label('Go-Live Date & Time')
                            ->timezone('Asia/Kolkata')
                            ->helperText('Set the exact date & time (IST) when the logo above should go live automatically.')
                            ->nullable()
                            ->seconds(false),   // hide seconds for clean UX
                    ]),
            ]);
    }
}

