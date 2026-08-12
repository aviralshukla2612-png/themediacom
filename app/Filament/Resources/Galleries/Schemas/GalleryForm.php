<?php

namespace App\Filament\Resources\Galleries\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
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
                            ->content(function ($record) {
                                if (!$record || !$record->image) return 'No image uploaded';
                                $url = \Illuminate\Support\Str::startsWith($record->image, ['new_gallary', 'client logo'])
                                    ? asset($record->image)
                                    : asset('storage/' . $record->image);
                                return new \Illuminate\Support\HtmlString('<img src="' . $url . '" style="max-height: 400px; width: 100%; object-fit: contain; border-radius: 8px; border: 1px solid #e5e7eb;" />');
                            })
                            ->hidden(fn ($record) => ! $record || ! $record->image)
                            ->columnSpanFull(),

                        // Category must come BEFORE the upload so the directory closure
                        // can read its value at upload time via $get('category')
                        Select::make('category')
                            ->label('Category')
                            ->options([
                                'rwa'       => 'RWA',
                                'btl'       => 'BTL Activity',
                                'mall'      => 'Mall Promotions',
                                'corporate' => 'Corporate Events',
                            ])
                            ->required()
                            ->live(),   // re-render upload field when category changes

                        FileUpload::make('image')
                            ->label('Upload New Image (Leave empty to keep current)')
                            ->image()
                            ->maxSize(10240)
                            // Use disk('public') → files stored in storage/app/public/gallery/
                            // accessible via public/storage/gallery/ (symlink)
                            // DB stores: 'gallery/filename.jpg'
                            ->disk('public')
                            ->directory('gallery')
                            ->preserveFilenames()
                            ->deleteUploadedFileUsing(fn () => null)
                            // On EDIT: show empty upload field (don't preload old file)
                            ->formatStateUsing(fn ($state, $record) => null)
                            // Only save to DB if a new file was actually uploaded
                            ->dehydrated(fn ($state) => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->columnSpanFull(),

                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0),
                    ]),
            ]);
    }
}
