<?php

namespace App\Filament\Resources\AboutCompanyResource\Pages;

use App\Filament\Resources\AboutCompanyResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAboutCompany extends ViewRecord
{
    protected static string $resource = AboutCompanyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
