<?php

namespace App\Filament\Resources\Inquiries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InquiriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->visibleFrom('md'),
                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('service_type')
                    ->label('Service / Subject')
                    ->searchable()
                    ->limit(40)
                    ->visibleFrom('md'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'New'       => 'danger',
                        'Contacted' => 'warning',
                        'Completed' => 'success',
                        default     => 'gray',
                    })
                    ->sortable()
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('created_at')
                    ->label('Date')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->visibleFrom('md'),

                // MOBILE CARD (Label-Value Pairs)
                \Filament\Tables\Columns\Layout\Stack::make([
                    TextColumn::make('name_mobile')
                        ->state(fn($record) => $record->name)
                        ->weight('bold')
                        ->size('lg'),
                        
                    \Filament\Tables\Columns\Layout\Split::make([
                        TextColumn::make('lbl_phone')->state(fn() => 'PHONE')->weight('bold')->color('gray')->grow(false)->size('sm'),
                        TextColumn::make('val_phone')->state(fn($record) => $record->phone)->alignEnd(),
                    ]),
                    
                    \Filament\Tables\Columns\Layout\Split::make([
                        TextColumn::make('lbl_service')->state(fn() => 'SERVICE')->weight('bold')->color('gray')->grow(false)->size('sm'),
                        TextColumn::make('val_service')->state(fn($record) => $record->service_type)->limit(40)->alignEnd(),
                    ]),
                    
                    \Filament\Tables\Columns\Layout\Split::make([
                        TextColumn::make('lbl_status')->state(fn() => 'STATUS')->weight('bold')->color('gray')->grow(false)->size('sm'),
                        TextColumn::make('val_status')
                            ->state(fn($record) => $record->status)
                            ->badge()
                            ->color(fn (string $state): string => match ($state) {
                                'New'       => 'danger',
                                'Contacted' => 'warning',
                                'Completed' => 'success',
                                default     => 'gray',
                            })
                            ->alignEnd(),
                    ]),
                    
                    \Filament\Tables\Columns\Layout\Split::make([
                        TextColumn::make('lbl_date')->state(fn() => 'DATE')->weight('bold')->color('gray')->grow(false)->size('sm'),
                        TextColumn::make('val_date')->state(fn($record) => $record->created_at)->dateTime('d M Y')->alignEnd(),
                    ]),
                ])->hiddenFrom('md')->space(3),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'New'       => 'New',
                        'Contacted' => 'Contacted',
                        'Completed' => 'Completed',
                    ]),
            ])
            ->recordActions([
                ViewAction::make()->iconButton()->tooltip('View'),
                EditAction::make()->iconButton()->tooltip('Edit / Update Status'),
                DeleteAction::make()->iconButton()->tooltip('Delete'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
