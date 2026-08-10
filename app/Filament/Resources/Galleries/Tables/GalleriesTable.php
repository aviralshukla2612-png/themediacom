<?php

namespace App\Filament\Resources\Galleries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class GalleriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('image')
                    ->label('Preview')
                    ->html()
                    ->formatStateUsing(function ($record) {
                        if (!$record->image) return '<span style="color:#9ca3af;font-size:0.75rem;">No image</span>';
                        $url = \Illuminate\Support\Str::startsWith($record->image, ['new_gallary', 'client']) 
                            ? '/' . $record->image 
                            : '/storage/' . $record->image;
                        return '<img src="' . $url . '" onerror="this.style.display=\'none\'" style="width:80px;height:50px;object-fit:cover;border-radius:4px;" />';
                    })
                    ->visibleFrom('md'),
                TextColumn::make('category')
                    ->label('Category')
                    ->searchable()
                    ->numeric()
                    ->sortable()
                    ->visibleFrom('md'),
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->visibleFrom('md'),

                // MOBILE CARD
                \Filament\Tables\Columns\Layout\Stack::make([
                    \Filament\Tables\Columns\Layout\Split::make([
                        TextColumn::make('lbl_image')->state(fn() => 'PREVIEW')->weight('bold')->color('gray')->grow(false)->size('sm'),
                        TextColumn::make('val_image')
                            ->state(fn($record) => $record->image)
                            ->html()
                            ->formatStateUsing(function ($record) {
                                if (!$record->image) return '<span style="color:#9ca3af;font-size:0.75rem;">No image</span>';
                                $url = \Illuminate\Support\Str::startsWith($record->image, ['new_gallary', 'client']) 
                                    ? '/' . $record->image 
                                    : '/storage/' . $record->image;
                                return '<img src="' . $url . '" onerror="this.style.display=\'none\'" style="width:80px;height:50px;object-fit:cover;border-radius:4px;" />';
                            })
                            ->alignEnd(),
                    ]),
                    
                    \Filament\Tables\Columns\Layout\Split::make([
                        TextColumn::make('lbl_cat')->state(fn() => 'CATEGORY')->weight('bold')->color('gray')->grow(false)->size('sm'),
                        TextColumn::make('val_cat')
                            ->state(fn($record) => $record->category)
                            ->alignEnd(),
                    ]),
                    
                    \Filament\Tables\Columns\Layout\Split::make([
                        TextColumn::make('lbl_date')->state(fn() => 'UPDATED')->weight('bold')->color('gray')->grow(false)->size('sm'),
                        TextColumn::make('val_date')->state(fn($record) => $record->updated_at)->dateTime('d M Y')->alignEnd(),
                    ]),
                ])->hiddenFrom('md')->space(3),
            ])
            ->filters([
                SelectFilter::make('category')
                    ->options([
                        'rwa'       => 'RWA',
                        'btl'       => 'BTL Activity',
                        'mall'      => 'Mall Promotions',
                        'corporate' => 'Corporate Events',
                    ]),
            ])
            ->recordActions([
                ViewAction::make()->iconButton()->tooltip('View'),
                EditAction::make()->iconButton()->tooltip('Edit'),
                DeleteAction::make()->iconButton()->tooltip('Delete'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
