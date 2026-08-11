<?php

namespace App\Filament\Resources\Campaigns\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CampaignsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->stackedOnMobile()
            ->columns([
                TextColumn::make('title')
                    ->label('Campaign Title')
                    ->searchable()
                    ->sortable()
                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                    ,
                TextColumn::make('category')
                    ->label('Category')
                    ->searchable()
                    ->badge()
                    ->color('gray')
                    ,
                TextColumn::make('image')
                    ->label('Preview')
                    ->html()
                    ->formatStateUsing(function ($record) {
                        if (!$record->image) return '<span style="color:#9ca3af;font-size:0.75rem;">No image</span>';
                        $url = \Illuminate\Support\Str::startsWith($record->image, ['new_gallary', 'client logo']) 
                            ? asset($record->image) 
                            : asset('storage/' . $record->image);
                        return '<img src="' . $url . '" onerror="this.style.display=\'none\'" style="width:80px;height:50px;object-fit:cover;border-radius:4px;" />';
                    })
                    ,
                IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable()
                    ->visibleFrom('md')
                    ,
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        default => 'gray',
                    })
                    ->visibleFrom('md')
                    ,
                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->visibleFrom('md')
                    ,

            ])
            ->filters([])
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

