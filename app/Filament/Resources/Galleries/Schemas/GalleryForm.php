<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GalleryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Gallery Details')
                    ->description('Manage gallery image and sorting order.')
                    ->schema([
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
                            ->directory(fn (callable $get) => 'new_gallary/' . match(strtolower($get('category') ?? '')) {
                                'rwa' => 'RWA',
                                'btl' => 'BTL Activity',
                                'mall' => 'Mall Promotions',
                                'corporate' => 'Corporate Events',
                                default => 'Uploads'
                            })
                            ->preserveFilenames()
                            ->deleteUploadedFileUsing(fn () => null)
                            ->formatStateUsing(fn () => null)
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->columnSpanFull(),
                        \Filament\Schemas\Components\Grid::make(2)
                            ->schema([
                                TextInput::make('category')
                                    ->required(),
                                TextInput::make('sort_order')
                                    ->numeric()
                                    ->default(0),
                            ]),
                    ]),
            ]);
    }
}
