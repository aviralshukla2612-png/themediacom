<?php

namespace App\Filament\Resources\Users;

use App\Filament\Resources\Users\Pages\ManageUsers;
use App\Models\User;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;
    protected static string | \UnitEnum | null $navigationGroup = 'Administration';

    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationLabel(): string
    {
        return 'Admin Users';
    }

    public static function getModelLabel(): string
    {
        return 'Admin User';
    }

    public static function getNavigationSort(): ?int
    {
        return 8;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                \Filament\Forms\Components\Hidden::make('username')
                    ->default(fn () => uniqid('admin_')),
                TextInput::make('password')
                    ->password()
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->confirmed()
                    ->maxLength(255),
                TextInput::make('password_confirmation')
                    ->password()
                    ->required(fn (string $context): bool => $context === 'create')
                    ->dehydrated(false)
                    ->maxLength(255),
                \Filament\Forms\Components\Select::make('role')
                    ->options([
                        'admin' => 'Admin',
                    ])
                    ->default('admin')
                    ->required(),
                \Filament\Forms\Components\Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ])
                    ->default('active')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ,
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable()
                    ,
                TextColumn::make('role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'editor' => 'warning',
                        'viewer' => 'success',
                        default => 'gray',
                    })
                    ,
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        default => 'gray',
                    })
                    ,
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ,

            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make()
                    ->iconButton()
                    ->before(function (EditAction $action, User $record, array $data) {
                        if ($record->role === 'admin' && $record->status === 'active' && $data['status'] === 'inactive') {
                            $activeAdminCount = User::where('role', 'admin')->where('status', 'active')->count();
                            if ($activeAdminCount <= 1) {
                                \Filament\Notifications\Notification::make()
                                    ->danger()
                                    ->title('Action denied')
                                    ->body('You cannot deactivate the last active administrator.')
                                    ->send();
                                $action->halt();
                            }
                        }
                    }),
                DeleteAction::make()
                    ->iconButton()
                    ->before(function (DeleteAction $action, User $record) {
                        if ($record->role === 'admin' && $record->status === 'active') {
                            $activeAdminCount = User::where('role', 'admin')->where('status', 'active')->count();
                            if ($activeAdminCount <= 1) {
                                \Filament\Notifications\Notification::make()
                                    ->danger()
                                    ->title('Action denied')
                                    ->body('You cannot delete the last active administrator.')
                                    ->send();
                                $action->halt();
                            }
                        }
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->iconButton()
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records, DeleteBulkAction $action) {
                            $activeAdminsToDelete = $records->filter(fn ($r) => $r->role === 'admin' && $r->status === 'active')->count();
                            $totalActiveAdmins = User::where('role', 'admin')->where('status', 'active')->count();
                            
                            if ($activeAdminsToDelete >= $totalActiveAdmins) {
                                \Filament\Notifications\Notification::make()
                                    ->danger()
                                    ->title('Action denied')
                                    ->body('You cannot delete all active administrators.')
                                    ->send();
                                $action->halt();
                            }
                            
                            $records->each(fn ($record) => $record->delete());
                        }),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageUsers::route('/'),
        ];
    }
}
