<?php

namespace App\Filament\Resources\ServicePageContents\Pages;

use App\Filament\Resources\ServicePageContents\ServicePageContentResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditServicePageContent extends EditRecord
{
    protected static string $resource = ServicePageContentResource::class;
    protected string $view = 'filament.resources.service-page-contents.edit';

    protected function getSaveFormAction(): \Filament\Actions\Action
    {
        return parent::getSaveFormAction()
            ->requiresConfirmation()
            ->modalHeading('Save changes')
            ->modalDescription('Are you sure you want to save these changes?')
            ->modalSubmitActionLabel('Yes, save changes');
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
