<?php

namespace App\Filament\Resources\SeoSettings;

use App\Filament\Resources\SeoSettings\Pages\CreateSeoSetting;
use App\Filament\Resources\SeoSettings\Pages\EditSeoSetting;
use App\Filament\Resources\SeoSettings\Pages\ListSeoSettings;
use App\Models\SeoSetting;
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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SeoSettingResource extends Resource
{
    protected static ?string $model = SeoSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeAlt;
    protected static string | \UnitEnum | null $navigationGroup = 'System';
    protected static ?int $navigationSort = 21;
    protected static ?string $navigationLabel = 'Global SEO';
    protected static ?string $pluralModelLabel = 'Global SEO';
    protected static ?string $modelLabel = 'Global SEO';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Global SEO Settings')
                ->description('These are the default SEO values used as fallback across all pages.')
                ->icon('heroicon-o-globe-alt')
                ->schema([
                    TextInput::make('seo_title')
                        ->label('Default Page Title')
                        ->placeholder('e.g. The Media Com | Brand Activation & BTL Agency')
                        ->helperText('Shown in browser tab and Google search results.')
                        ->columnSpanFull(),
                    Textarea::make('seo_description')
                        ->label('Default Meta Description')
                        ->rows(3)
                        ->placeholder('A concise description of the website for search engines...')
                        ->helperText('Recommended: 150–160 characters.')
                        ->columnSpanFull(),
                    FileUpload::make('seo_image')
                        ->label('Default Open Graph Image')
                        ->image()
                        ->disk('public')
                        ->directory('seo')
                        ->imagePreviewHeight('120')
                        ->helperText('Image shown when pages are shared on social media. Recommended: 1200×630px.')
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('seo_title')->label('SEO Title')->limit(60),
                TextColumn::make('seo_description')->label('Meta Description')->limit(80),
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y, H:i')
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
            'index'  => ListSeoSettings::route('/'),
            'create' => CreateSeoSetting::route('/create'),
            'edit'   => EditSeoSetting::route('/{record}/edit'),
        ];
    }
}
