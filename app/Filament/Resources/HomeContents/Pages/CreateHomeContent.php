<?php

namespace App\Filament\Resources\HomeContents\Pages;

use App\Filament\Resources\HomeContents\HomeContentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateHomeContent extends CreateRecord
{
    protected static string $resource = HomeContentResource::class;
}
