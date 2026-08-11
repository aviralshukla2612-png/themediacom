<?php

namespace App\Filament\Resources\HomeContents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HomeContentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('heading')
                    ->label('Hero Heading')
                    ->searchable()
                    ->limit(50)->wrap(),
                TextColumn::make('paragraph')
                    ->label('Paragraph')
                    ->limit(60)->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('bg_image')
                    ->label('Background')
                    ->disk('public')
                    ->height(50)
                    ->width(80),
                TextColumn::make('cta_text')
                    ->label('CTA Button'),
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([])
            ->recordActions([
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
