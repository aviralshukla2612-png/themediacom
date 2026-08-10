<?php

namespace App\Filament\Resources\AboutContents\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class AboutContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('About Page')
                    ->description('Main content for the About Us page.')
                    ->icon('heroicon-o-information-circle')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('heading')
                                ->label('Page Heading')
                                ->placeholder('e.g. About The Media Com')
                                ->required(),
                            TextInput::make('subtitle')
                                ->label('Subtitle / Tagline')
                                ->placeholder('e.g. Turning ideas into experiences...'),
                        ]),
                        Textarea::make('paragraph')
                            ->label('Main Description')
                            ->rows(5)
                            ->placeholder('Write a description of the company...')
                            ->columnSpanFull(),
                        FileUpload::make('hero_image')
                            ->label('Hero Background Image')
                            ->image()
                            ->disk('public')
                            ->directory('about')
                            ->imagePreviewHeight('120')
                            ->columnSpanFull(),
                    ]),

                Section::make('BTL Metrics')
                    ->description('Statistics shown on the Services page (managed in Services Page Content).')
                    ->icon('heroicon-o-chart-bar')
                    ->collapsed()
                    ->schema([
                        Textarea::make('metrics')
                            ->label('Additional Metrics / Notes (JSON or text)')
                            ->rows(3)
                            ->helperText('For BTL-specific metrics (People Reached, Malls, Locations), edit them in Services Page Content in the sidebar.')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
