<?php

namespace App\Filament\Resources\Campaigns\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CampaignForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Grid::make(3)
                    ->schema([
                        \Filament\Schemas\Components\Grid::make(1)
                            ->columnSpan(2)
                            ->schema([
                                \Filament\Schemas\Components\Section::make('General Information')
                                    ->schema([
                                        \Filament\Schemas\Components\Grid::make(2)
                                            ->schema([
                                                TextInput::make('title')->required(),
                                                TextInput::make('category')->required(),
                                            ]),
                                        \Filament\Forms\Components\Placeholder::make('image_preview')
                                            ->label('Current Image')
                                            ->content(fn ($record) => $record && $record->image ? new \Illuminate\Support\HtmlString('<img src="' . asset($record->image) . '" style="max-height: 400px; width: 100%; object-fit: contain; border-radius: 8px; border: 1px solid #e5e7eb;" />') : 'No image uploaded')
                                            ->hidden(fn ($record) => ! $record || ! $record->image)
                                            ->columnSpanFull(),
                                        FileUpload::make('image')
                                            ->label('Upload New Image (Leave empty to keep current)')
                                            ->image()
                                            ->maxSize(5120)
                                            ->disk('public_root')
                                            ->directory('new_gallary')
                                            ->preserveFilenames()
                                            ->deleteUploadedFileUsing(fn () => null)
                                            ->formatStateUsing(fn () => null)
                                            ->dehydrated(fn ($state) => filled($state))
                                            ->required(fn (string $operation): bool => $operation === 'create')
                                            ->columnSpanFull(),
                                    ]),
                                \Filament\Schemas\Components\Section::make('Case Study Content')
                                    ->schema([
                                        Textarea::make('problem')->default(null)->columnSpanFull(),
                                        Textarea::make('solution')->default(null)->columnSpanFull(),
                                        Textarea::make('result')->default(null)->columnSpanFull(),
                                    ]),
                            ]),
                        \Filament\Schemas\Components\Grid::make(1)
                            ->columnSpan(1)
                            ->schema([
                                \Filament\Schemas\Components\Section::make('Metrics')
                                    ->schema([
                                        TextInput::make('metrics_1_label')->label('Metric 1 Label')->default(null),
                                        TextInput::make('metrics_1_val')->label('Metric 1 Value')->default(null),
                                        TextInput::make('metrics_2_label')->label('Metric 2 Label')->default(null),
                                        TextInput::make('metrics_2_val')->label('Metric 2 Value')->default(null),
                                    ]),
                                \Filament\Schemas\Components\Section::make('Status')
                                    ->schema([
                                        Toggle::make('featured')->label('Feature on Homepage'),
                                    ]),
                            ]),
                    ]),
            ]);
    }
}
