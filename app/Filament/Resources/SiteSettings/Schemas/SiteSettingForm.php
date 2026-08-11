<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Forms\Components\TextInput::make('site_name')
                    ->label('Site Name')
                    ->placeholder('e.g. The Media Com')
                    ->helperText('Fallback text used when the logo cannot be loaded.')
                    ->required(),
                \Filament\Forms\Components\FileUpload::make('logo_image')
                    ->label('Site Logo')
                    ->image()
                    ->directory('site')
                    ->nullable(),
                \Filament\Forms\Components\FileUpload::make('favicon_image')
                    ->label('Site Favicon')
                    ->image()
                    ->directory('site')
                    ->imagePreviewHeight('100')
                    ->helperText('Shown on browser tabs. Recommended: 32x32px or 64x64px square image.')
                    ->nullable(),
            ]);
    }
}
