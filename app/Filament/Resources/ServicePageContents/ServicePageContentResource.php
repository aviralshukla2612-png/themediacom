<?php

namespace App\Filament\Resources\ServicePageContents;

use App\Filament\Resources\ServicePageContents\Pages\CreateServicePageContent;
use App\Filament\Resources\ServicePageContents\Pages\EditServicePageContent;
use App\Filament\Resources\ServicePageContents\Pages\ListServicePageContents;
use App\Models\ServicePageContent;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServicePageContentResource extends Resource
{
    protected static ?string $model = ServicePageContent::class;
    protected static bool $shouldRegisterNavigation = false;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;
    protected static string | \UnitEnum | null $navigationGroup = 'Website Content';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationLabel = 'Services Page';
    protected static ?string $pluralModelLabel = 'Services Page Content';
    protected static ?string $modelLabel = 'Services Page Content';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('BTL Metrics')
                ->description('Statistics shown prominently on the Services page.')
                ->icon('heroicon-o-chart-bar')
                ->schema([
                    Grid::make(3)->schema([
                        TextInput::make('btl_metric_reached')
                            ->label('People Reached')
                            ->placeholder('e.g. 5M+')
                            ->helperText('Total consumers activated / reached'),
                        TextInput::make('btl_metric_malls')
                            ->label('Malls Reached')
                            ->placeholder('e.g. 200+')
                            ->helperText('Number of malls activated in'),
                        TextInput::make('btl_metric_locations')
                            ->label('Locations')
                            ->placeholder('e.g. 50+')
                            ->helperText('Cities / locations covered'),
                    ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('btl_metric_reached')
                    ->label('People Reached'),
                TextColumn::make('btl_metric_malls')
                    ->label('Malls'),
                TextColumn::make('btl_metric_locations')
                    ->label('Locations'),
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make()->iconButton()->tooltip('Edit'),
                DeleteAction::make()->iconButton()->tooltip('Delete'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListServicePageContents::route('/'),
            'create' => CreateServicePageContent::route('/create'),
            'edit'   => EditServicePageContent::route('/{record}/edit'),
        ];
    }
}
