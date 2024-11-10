<?php

namespace App\Filament\Resources\AboutDetailsResource\Pages;

use App\Filament\Resources\AboutDetailsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAboutDetails extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;
    protected static string $resource = AboutDetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\EditAction::make(),
        ];
    }
}
