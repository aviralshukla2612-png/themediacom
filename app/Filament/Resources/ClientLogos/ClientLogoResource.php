<?php

namespace App\Filament\Resources\ClientLogos;

use App\Filament\Resources\ClientLogos\Pages\CreateClientLogo;
use App\Filament\Resources\ClientLogos\Pages\EditClientLogo;
use App\Filament\Resources\ClientLogos\Pages\ListClientLogos;
use App\Models\ClientLogo;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class ClientLogoResource extends Resource
{
    protected static ?string $model = ClientLogo::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingStorefront;
    protected static string | \UnitEnum | null $navigationGroup = 'Website Content';
    protected static ?int $navigationSort = 9;
    protected static ?string $navigationLabel = 'Client Logos';
    protected static ?string $pluralModelLabel = 'Client Logos';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Client / Brand Logo')
                ->description('Logos displayed in the "Trusted By" section.')
                ->icon('heroicon-o-building-storefront')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->label('Client Name')
                            ->required(),
                        FileUpload::make('image')
                            ->label('Logo Image')
                            ->image()
                            ->disk('public')
                            ->directory('clients')
                            ->required(),
                    ]),
                    Grid::make(2)->schema([
                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(0),
                        Toggle::make('status')
                            ->label('Active (Visible)')
                            ->default(true),
                    ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('image')
                    ->label('Logo')
                    ->html()
                    ->getStateUsing(function ($record) {
                        $url = \Illuminate\Support\Str::startsWith($record->image, 'client logo') 
                            ? asset($record->image) 
                            : asset('storage/' . $record->image);
                        return '<img src="' . $url . '" style="height: 40px; object-fit: contain;">';
                    })
                    ,
                TextColumn::make('name')
                    ->label('Client Name')
                    ->searchable()
                    ->sortable()
                    ,
                TextColumn::make('sort_order')
                    ->label('Sort Order')
                    ->sortable()
                    ->visibleFrom('md')
                    ,
                IconColumn::make('status')
                    ->label('Active')
                    ->boolean()
                    ->sortable()
                    ->visibleFrom('md')
                    ,
                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->visibleFrom('md')
                    ,

            ])
            ->defaultSort('sort_order', 'asc')
            ->actions([
                ViewAction::make()->iconButton()->tooltip('View'),
                EditAction::make()->iconButton()->tooltip('Edit'),
                DeleteAction::make()->iconButton()->tooltip('Delete'),
            ])
            ->bulkActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListClientLogos::route('/'),
            'create' => CreateClientLogo::route('/create'),
            'edit' => EditClientLogo::route('/{record}/edit'),
        ];
    }
}
