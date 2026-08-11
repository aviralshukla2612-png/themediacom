<?php

namespace App\Filament\Resources\CorporateContents;

use App\Filament\Resources\CorporateContents\Pages\CreateCorporateContent;
use App\Filament\Resources\CorporateContents\Pages\EditCorporateContent;
use App\Filament\Resources\CorporateContents\Pages\ListCorporateContents;
use App\Models\CorporateContent;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CorporateContentResource extends Resource
{
    protected static ?string $model = CorporateContent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBuildingOffice2;
    protected static string | \UnitEnum | null $navigationGroup = 'Website Content';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationLabel = 'Corporate';
    protected static ?string $pluralModelLabel = 'Corporate Content';
    protected static ?string $modelLabel = 'Corporate Content';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Corporate Page')
                ->description('Content shown on the Corporate Events page.')
                ->icon('heroicon-o-building-office-2')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('page_title')
                            ->label('Page Title')
                            ->placeholder('e.g. Executive Experiences')
                            ->required(),
                        FileUpload::make('hero_bg')
                            ->label('Hero Background Image')
                            ->image()
                            ->disk('public')
                            ->directory('corporate')
                            ->imagePreviewHeight('120'),
                    ]),
                    Textarea::make('page_subtitle')
                        ->label('Page Subtitle')
                        ->rows(2)
                        ->placeholder('A short description of the Corporate Events service...')
                        ->columnSpanFull(),
                ]),

            Section::make('Page Images')
                ->description('Two supporting images shown on the Corporate page.')
                ->icon('heroicon-o-photo')
                ->schema([
                    Grid::make(2)->schema([
                        FileUpload::make('img_1')
                            ->label('Image 1')
                            ->image()
                            ->disk('public')
                            ->directory('corporate')
                            ->imagePreviewHeight('120'),
                        FileUpload::make('img_2')
                            ->label('Image 2')
                            ->image()
                            ->disk('public')
                            ->directory('corporate')
                            ->imagePreviewHeight('120'),
                    ]),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page_title')
                    ->label('Page Title')
                    ->searchable()
                    ->weight('bold')
                    ,
                ImageColumn::make('hero_bg')
                    ->label('Hero BG')
                    ->disk('public')
                    ->height(50)->width(80)
                    ,
                TextColumn::make('page_subtitle')
                    ->label('Subtitle')
                    ->limit(60)->wrap()
                    ,
                TextColumn::make('updated_at')
                    ->label('Updated At')
                    ->dateTime('d M Y')
                    ->sortable()
                    ,

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
            'index'  => ListCorporateContents::route('/'),
            'create' => CreateCorporateContent::route('/create'),
            'edit'   => EditCorporateContent::route('/{record}/edit'),
        ];
    }
}
