<?php

namespace App\Filament\Resources\CorporateContents\Pages;

use App\Filament\Resources\CorporateContents\CorporateContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCorporateContents extends ListRecords
{
    protected static string $resource = CorporateContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
