<?php

namespace App\Filament\Resources\SiteSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class SiteSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('site_name')->label('Site Name'),
                \Filament\Tables\Columns\ImageColumn::make('logo_image')->label('Logo'),
                \Filament\Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y, H:i'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
