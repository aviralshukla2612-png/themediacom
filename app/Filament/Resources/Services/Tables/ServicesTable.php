<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Service Name')
                    ->searchable()
                    ->sortable()
                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                    ->visibleFrom('md'),
                TextColumn::make('icon')
                    ->label('Icon')
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('description')
                    ->label('Description')
                    ->limit(60)
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->color('gray')
                    ->visibleFrom('md'),
                    
                // MOBILE CARD
                \Filament\Tables\Columns\Layout\Stack::make([
                    TextColumn::make('title_mobile')
                        ->state(fn($record) => $record->title)
                        ->weight('bold')
                        ->size('lg'),
                        
                    \Filament\Tables\Columns\Layout\Split::make([
                        TextColumn::make('lbl_icon')->state(fn() => 'ICON')->weight('bold')->color('gray')->grow(false)->size('sm'),
                        TextColumn::make('val_icon')->state(fn($record) => $record->icon)->alignEnd(),
                    ]),
                    
                    \Filament\Tables\Columns\Layout\Split::make([
                        TextColumn::make('lbl_desc')->state(fn() => 'DESCRIPTION')->weight('bold')->color('gray')->grow(false)->size('sm'),
                        TextColumn::make('val_desc')->state(fn($record) => $record->description)->limit(60)->alignEnd(),
                    ]),

                    \Filament\Tables\Columns\Layout\Split::make([
                        TextColumn::make('lbl_date')->state(fn() => 'UPDATED')->weight('bold')->color('gray')->grow(false)->size('sm'),
                        TextColumn::make('val_date')->state(fn($record) => $record->updated_at)->dateTime('d M Y')->alignEnd(),
                    ]),
                ])->hiddenFrom('md')->space(3),
                IconColumn::make('status')
                    ->label('Active')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('status')->label('Active'),
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
