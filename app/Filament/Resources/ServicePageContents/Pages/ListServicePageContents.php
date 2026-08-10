<?php

namespace App\Filament\Resources\ServicePageContents\Pages;

use App\Filament\Resources\ServicePageContents\ServicePageContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListServicePageContents extends ListRecords
{
    protected static string $resource = ServicePageContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
