<?php

namespace App\Filament\Resources\Galleries\Pages;

use App\Filament\Resources\Galleries\GalleryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListGalleries extends ListRecords
{
    protected static string $resource = GalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('clean_broken_images')
                ->label('Clean Broken Images')
                ->icon('heroicon-o-trash')
                ->color('danger')
                ->requiresConfirmation()
                ->modalHeading('Clean Broken Images')
                ->modalDescription('Are you sure you want to scan for and delete all broken image records from the database? This action cannot be undone.')
                ->modalSubmitActionLabel('Yes, clean them up')
                ->action(function () {
                    $galleries = \App\Models\Gallery::all();
                    $deletedCount = 0;

                    foreach ($galleries as $gallery) {
                        $path = $gallery->image;
                        if (\Illuminate\Support\Str::startsWith($path, ['new_gallary', 'client logo'])) {
                            $physicalPath = public_path($path);
                            $exists = file_exists($physicalPath);
                        } else {
                            $exists = \Illuminate\Support\Facades\Storage::disk('public')->exists($path);
                        }

                        if (!$exists) {
                            $gallery->delete();
                            $deletedCount++;
                        }
                    }

                    \Filament\Notifications\Notification::make()
                        ->title('Cleanup Complete')
                        ->body("Successfully deleted {$deletedCount} broken image records.")
                        ->success()
                        ->send();
                }),
            CreateAction::make(),
        ];
    }
}
