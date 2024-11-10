<?php

namespace App\Filament\Resources\ServiceInfoResource\Pages;

use App\Filament\Resources\ServiceInfoResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewServiceInfo extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;
    protected static string $resource = ServiceInfoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\EditAction::make(),
        ];
    }
}
