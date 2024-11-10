<?php

namespace App\Filament\Resources\CompanyDetailsResource\Pages;

use App\Filament\Resources\CompanyDetailsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCompanyDetails extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;
    protected static string $resource = CompanyDetailsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\EditAction::make(),
        ];
    }
}
