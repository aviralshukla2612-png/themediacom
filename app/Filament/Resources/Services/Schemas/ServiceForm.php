<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Service Information')
                ->description('Details about this service shown on the website.')
                ->icon('heroicon-o-sparkles')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('title')
                            ->label('Service Name')
                            ->placeholder('e.g. Brand Activation')
                            ->required(),
                        TextInput::make('icon')
                            ->label('Icon / Emoji')
                            ->placeholder('e.g. 🎯 or heroicon-o-...')
                            ->helperText('An emoji or icon identifier for this service.'),
                    ]),
                    Textarea::make('description')
                        ->label('Service Description')
                        ->rows(4)
                        ->placeholder('Describe this service...')
                        ->columnSpanFull(),
                    Grid::make(2)->schema([
                        TextInput::make('link')
                            ->label('Service Link / Slug')
                            ->placeholder('e.g. /services/brand-activation'),
                        Toggle::make('status')
                            ->label('Active (visible on website)')
                            ->default(true),
                    ]),
                ]),
        ]);
    }
}
