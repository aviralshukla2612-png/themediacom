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
            ->stackedOnMobile()
            ->columns([
                TextColumn::make('image')
                    ->label('Preview')
                    ->html()
                    ->formatStateUsing(function ($record) {
                        if (!$record->image) return '<span style="color:#9ca3af;font-size:0.75rem;">No image</span>';
                        $url = \Illuminate\Support\Str::startsWith($record->image, ['new_gallary', 'client logo']) 
                            ? '/' . ltrim($record->image, '/') 
                            : '/storage/' . ltrim($record->image, '/');
                        
                        // Fix for HTML Purifier breaking on spaces and parentheses in URLs
                        $safeUrl = str_replace([' ', '(', ')'], ['%20', '%28', '%29'], $url);

                        return '<img src="' . $safeUrl . '" style="width:80px;height:50px;object-fit:cover;border-radius:4px;" />';
                    })
                    ,
                TextColumn::make('category')
                    ->label('Category')
                    ->searchable()
                    ->numeric()
                    ->sortable()
                    ,
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->visibleFrom('md')
                    ,

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

