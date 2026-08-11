<?php

namespace App\Filament\Resources\ContactSettings;

use App\Filament\Resources\ContactSettings\Pages\CreateContactSetting;
use App\Filament\Resources\ContactSettings\Pages\EditContactSetting;
use App\Filament\Resources\ContactSettings\Pages\ListContactSettings;
use App\Models\ContactSetting;
use BackedEnum;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContactSettingResource extends Resource
{
    protected static ?string $model = ContactSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhone;
    protected static string | \UnitEnum | null $navigationGroup = 'System';
    protected static ?int $navigationSort = 20;
    protected static ?string $navigationLabel = 'Contact & Business Info';
    protected static ?string $pluralModelLabel = 'Contact & Business Info';
    protected static ?string $modelLabel = 'Contact Info';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Business Contact Details')
                ->description('This information is displayed on the Contact page and footer.')
                ->icon('heroicon-o-phone')
                ->schema([
                        \Filament\Forms\Components\Textarea::make('footer_text')
                            ->label('Global Footer Text')
                            ->rows(3)
                            ->columnSpanFull()
                            ->helperText('Short description shown in the footer of the website.'),
                    Grid::make(2)->schema([
                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->placeholder('e.g. info@themediacom.com'),
                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel()
                            ->placeholder('e.g. +91 98765 43210'),
                    ]),
                    Textarea::make('address')
                        ->label('Business Address')
                        ->rows(3)
                        ->placeholder('Full mailing address...')
                        ->columnSpanFull(),
                    TextInput::make('maps_url')
                        ->label('Google Maps URL')
                        ->url()
                        ->placeholder('https://maps.google.com/...')
                        ->helperText('The Google Maps embed link for the contact page.')
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('email')->label('Email'),
                TextColumn::make('phone')->label('Phone'),
                TextColumn::make('address')->label('Address')->limit(50),
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
            'index'  => ListContactSettings::route('/'),
            'create' => CreateContactSetting::route('/create'),
            'edit'   => EditContactSetting::route('/{record}/edit'),
        ];
    }
}
