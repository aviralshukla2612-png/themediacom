<?php

namespace App\Filament\Resources\HomeContents\Pages;

use App\Filament\Resources\HomeContents\HomeContentResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHomeContents extends ListRecords
{
    protected static string $resource = HomeContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
