<?php

namespace App\Filament\Resources\Inquiries\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class InquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Customer Information')
                ->description('The contact who submitted this quote request.')
                ->icon('heroicon-o-user')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('name')
                            ->label('Full Name')
                            ->required(),
                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required(),
                    ]),
                    Grid::make(2)->schema([
                        TextInput::make('phone')
                            ->label('Phone Number')
                            ->tel(),
                        TextInput::make('company')
                            ->label('Company / Brand'),
                    ]),
                ]),

            Section::make('Request Details')
                ->description('What the customer is requesting.')
                ->icon('heroicon-o-document-text')
                ->schema([
                    Grid::make(2)->schema([
                        TextInput::make('service_type')
                            ->label('Service Requested'),
                        TextInput::make('budget_range')
                            ->label('Budget Range'),
                    ]),
                    Textarea::make('message')
                        ->label('Message')
                        ->rows(5)
                        ->columnSpanFull(),
                ]),

            Section::make('Pipeline Status')
                ->description('Track the progress of this lead.')
                ->icon('heroicon-o-arrow-path')
                ->schema([
                    Select::make('status')
                        ->label('Current Status')
                        ->options([
                            'New'       => 'New',
                            'Contacted' => 'Contacted',
                            'Completed' => 'Completed',
                        ])
                        ->required()
                        ->default('New'),
                ]),
        ]);
    }
}
