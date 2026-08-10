<?php

namespace App\Filament\Resources\CorporateContents\Pages;

use App\Filament\Resources\CorporateContents\CorporateContentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCorporateContent extends EditRecord
{
    protected static string $resource = CorporateContentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
