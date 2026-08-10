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
            ->columns([
                TextColumn::make('title')
                    ->label('Campaign Title')
                    ->searchable()
                    ->sortable()
                    ->weight(\Filament\Support\Enums\FontWeight::Bold)
                    ->visibleFrom('md'),
                TextColumn::make('category')
                    ->label('Category')
                    ->searchable()
                    ->badge()
                    ->color('gray')
                    ->visibleFrom('md'),
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
                IconColumn::make('featured')
                    ->label('Featured')
                    ->boolean()
                    ->sortable()
                    ->visibleFrom('md'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        default => 'gray',
                    })
                    ->visibleFrom('md'),
                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->visibleFrom('md'),

                // MOBILE CARD
                \Filament\Tables\Columns\Layout\Stack::make([
                    TextColumn::make('title_mobile')
                        ->state(fn($record) => $record->title)
                        ->weight('bold')
                        ->size('lg'),

                    \Filament\Tables\Columns\Layout\Split::make([
                        TextColumn::make('lbl_cat')->state(fn() => 'CATEGORY')->weight('bold')->color('gray')->grow(false)->size('sm'),
                        TextColumn::make('val_cat')
                            ->state(fn($record) => $record->category)
                            ->badge()
                            ->color('gray')
                            ->alignEnd(),
                    ]),
                        
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
                        TextColumn::make('lbl_feat')->state(fn() => 'FEATURED')->weight('bold')->color('gray')->grow(false)->size('sm'),
                        IconColumn::make('val_feat')
                            ->state(fn($record) => $record->featured)
                            ->boolean()
                            ->alignEnd(),
                    ]),

                    \Filament\Tables\Columns\Layout\Split::make([
                        TextColumn::make('lbl_status')->state(fn() => 'STATUS')->weight('bold')->color('gray')->grow(false)->size('sm'),
                        TextColumn::make('val_status')
                            ->state(fn($record) => $record->status)
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'active' => 'success',
                                'inactive' => 'danger',
                                default => 'gray',
                            })
                            ->alignEnd(),
                    ]),

                    \Filament\Tables\Columns\Layout\Split::make([
                        TextColumn::make('lbl_date')->state(fn() => 'DATE')->weight('bold')->color('gray')->grow(false)->size('sm'),
                        TextColumn::make('val_date')->state(fn($record) => $record->created_at)->dateTime('d M Y')->alignEnd(),
                    ]),
                ])->hiddenFrom('md')->space(3),
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
