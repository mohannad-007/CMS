<?php

namespace App\Filament\Resources\AboutDetailsResource\Pages;

use App\Filament\Resources\AboutDetailsResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAboutDetails extends ListRecords
{
    protected static string $resource = AboutDetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
