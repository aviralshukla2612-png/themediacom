<?php

namespace App\Filament\Resources\HomeContents\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class HomeContentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Hero Section')
                    ->description('The main banner shown at the top of the homepage.')
                    ->icon('heroicon-o-home')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('heading')
                                ->label('Hero Heading')
                                ->placeholder('e.g. Turning Brands into Experiences')
                                ->required()
                                ->columnSpan(1),
                            FileUpload::make('bg_image')
                                ->label('Hero Background Image')
                                ->image()
                                ->disk('public')
                                ->directory('home')
                                ->imagePreviewHeight('120')
                                ->columnSpan(1),
                        ]),
                        Textarea::make('paragraph')
                            ->label('Hero Paragraph')
                            ->placeholder('A short description shown below the heading...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Call to Action')
                    ->description('The button shown in the hero section.')
                    ->icon('heroicon-o-cursor-arrow-rays')
                    ->schema([
                        Grid::make(2)->schema([
                            TextInput::make('cta_text')
                                ->label('Button Text')
                                ->placeholder('e.g. Get a Quote'),
                            TextInput::make('cta_link')
                                ->label('Button URL')
                                ->placeholder('e.g. /contact or https://...'),
                        ]),
                    ]),
            ]);
    }
}
