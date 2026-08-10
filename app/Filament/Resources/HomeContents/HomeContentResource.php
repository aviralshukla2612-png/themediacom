<?php

namespace App\Filament\Resources\HomeContents;

use App\Filament\Resources\HomeContents\Pages\CreateHomeContent;
use App\Filament\Resources\HomeContents\Pages\EditHomeContent;
use App\Filament\Resources\HomeContents\Pages\ListHomeContents;
use App\Filament\Resources\HomeContents\Schemas\HomeContentForm;
use App\Filament\Resources\HomeContents\Tables\HomeContentsTable;
use App\Models\HomeContent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomeContentResource extends Resource
{
    protected static ?string $model = HomeContent::class;
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $pluralModelLabel = 'Home Content';
    protected static ?string $modelLabel = 'Home Content';

    public static function form(Schema $schema): Schema
    {
        return HomeContentForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeContentsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListHomeContents::route('/'),
            'create' => CreateHomeContent::route('/create'),
            'edit'   => EditHomeContent::route('/{record}/edit'),
        ];
    }
}
